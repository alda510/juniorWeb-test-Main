<?php

namespace backAlda\publicHtml;

use backAlda\config\{
    Constantes\Constantes,
    Rotas,
};
use Throwable;

class Index extends Rest
{
    private function coletarParametrosGet(): array
    {
        $urlComponents = parse_url(PROJETO_URL);
        $parametros = [];
        if (!empty($urlComponents['query'])) {
            parse_str($urlComponents['query'], $parametros);
        }
        return $parametros;
    }

    private function coletarParametrosPost(): array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function __construct()
    {
        
        (new Constantes());
        (new Rotas());
    }

    public function validarRota(): void
    {
        foreach (ROTAS as $chave => $valor) {
            foreach ($valor as $rota) {
                if (PROJETO_URI === $rota['uri']) {
                    if ($_SERVER['REQUEST_METHOD'] !== $chave) {
                        $this->definirRetornoHttp(400);
                    }
                    if (!$rota['habilitado']) {
                        $this->definirRetornoHttp(503);
                    }
                    $parametros = match ($chave) {
                        'GET' => $this->coletarParametrosGet(),
                        'DELETE' => $this->coletarParametrosPost(),
                        'POST' => $this->coletarParametrosPost(),
                        default => $this->definirRetornoHttp(403),
                    };
                    $this->chamarMetodo($rota, $parametros);
                }
            }
        }
        $this->definirRetornoHttp(404);
    }

    public function chamarMetodo(array $rota, array $parametros): void
    {
        if (class_exists($rota['namespace'])) {
            $controlador = new $rota['namespace'];
            $metodo = $rota['method'];
            
            if (method_exists($controlador, $metodo)) {
                try {
                    $conteudo = $controlador->$metodo($parametros);
                    $this->definirRetornoHttp($conteudo['code'], $conteudo);
                } catch (Throwable $e) {
                    $this->definirRetornoHttp(500, [$e]);
                }
            }
            $this->definirRetornoHttp(405);
        }
        $this->definirRetornoHttp(404);
    }
}