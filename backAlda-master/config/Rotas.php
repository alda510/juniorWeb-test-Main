<?php

namespace backAlda\config;

use backAlda\config\Rest\Produtos;

class Rotas
{
    private function construirRotas(): void
    {
        (new Produtos());
    }

    private function definirRotasGet(): array
    {
        return [
            ROTA_LISTAR_PRODUTOS,
        ];
    }

    private function definirRotasPost(): array
    {
        return [
            ROTA_CADASTRAR_PRODUTOS,
        ];
    }

    private function definirRotasDelete(): array
    {
        return [
            ROTA_DELETAR_PRODUTOS,
        ];
    }

    private function definirRotasExistentes(): void
    {
        define('ROTAS', [
            'GET' => $this->definirRotasGet(),
            'POST' => $this->definirRotasPost(),
            'DELETE' => $this->definirRotasDelete(),
        ]);
    }

    public function __construct()
    {
        $this->construirRotas();
        $this->definirRotasExistentes();
    }
}