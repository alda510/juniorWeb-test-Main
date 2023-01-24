<?php

namespace backAlda\config\Rest;

class Produtos
{
    private function definirRota(): void
    {
        define('ROTA_LISTAR_PRODUTOS', [
            'uri' => '/scandiweb/juniorTestGustavoAlda/produtos',
            'namespace' => 'backAlda\Src\Controllers\Produtos\Produtos',
            'habilitado' => true,
            'method' => 'listarProdutos',
        ]);

        define('ROTA_CADASTRAR_PRODUTOS', [
            'uri' => '/scandiweb/juniorTestGustavoAlda/produtos/cadastrar',
            'namespace' => 'backAlda\Src\Controllers\Produtos\Produtos',
            'habilitado' => true,
            'method' => 'cadastrarProduto',
        ]);

        define('ROTA_DELETAR_PRODUTOS', [
            'uri' => '/scandiweb/juniorTestGustavoAlda/produtos/deletar',
            'namespace' => 'backAlda\Src\Controllers\Produtos\Produtos',
            'habilitado' => true,
            'method' => 'deletarProduto',
        ]);
    }

    public function __construct()
    {
        $this->definirRota();
    }
}