<?php

namespace backAlda\Src\Controllers\Produtos;

use backAlda\Src\Models\Produtos\ModelProdutos;
use backAlda\Resources\Common\Common;

class Produtos
{
    private $model;

    public function __construct()
    {
        $this->model = new ModelProdutos;
    }
    
    public function listarProdutos(): array
    {
        $produtos = $this->model->listarProdutos();
        $livros = $this->model->listarLivros();
        $dvds = $this->model->listarDvds();
        $furniture = $this->model->listarFurniture();
        foreach ($produtos as $chave => $valor) {
            $produtos[$chave]['valor'] = $valor['valor']/100;
            if ($valor['tipo'] === 'livros') {
                foreach ($livros as $livro) {
                    if ($livro['sku'] === $valor['sku']) {
                        $produtos[$chave]['properties']['peso'] = $livro['peso']/100;
                    }
                }
            }
            if ($valor['tipo'] === 'dvds') {
                foreach ($dvds as $dvd) {
                    if ($dvd['sku'] === $valor['sku']) {
                        $produtos[$chave]['properties']['tamanho'] = $dvd['tamanho']/100;
                    }
                }
            }
            if ($valor['tipo'] === 'furniture') {
                foreach ($furniture as $furn) {
                    if ($furn['sku'] === $valor['sku']) {
                        $dimensions = $furn['largura']/100 . 'x' . $furn['comprimento']/100 . 'x' . $furn['altura']/100;
                        $produtos[$chave]['properties']['dimensions'] = $dimensions;
                    }
                }
            }
        }
        return Common::prepararRetorno(200, 'Sucesso', $produtos);
    }
    
    public function cadastrarProduto(array $parametros): array
    {
        $parametros['valor'] = $parametros['valor'] * 100;
        $produto = [
            'sku' => $parametros['sku'],
            'nome' => $parametros['nome'],
            'valor' => $parametros['valor'],
            'tipo' => $parametros['tipo'],
        ];
        unset($parametros['valor']);
        unset($parametros['nome']);
        unset($parametros['tipo']);
        $this->model->cadastrarProduto($produto);
        switch ($produto['tipo']) {
            case 'livros':
                $parametros['peso'] = $parametros['peso'] * 100;
                $this->model->cadastrarLivro($parametros);
                break;
            case 'dvds':
                $parametros['peso'] = $parametros['peso'] * 100;
                $this->model->cadastrarDvd($parametros);
                break;
            case 'furniture':
                    $parametros['largura'] = $parametros['largura'] * 100;
                    $parametros['altura'] = $parametros['altura'] * 100;
                    $parametros['comprimento'] = $parametros['comprimento'] * 100;
                    $this->model->cadastrarFurniture($parametros);
                break;
            default:
                return Common::prepararRetorno(500, 'Tipo não suportado');
                break;
        }
        return Common::prepararRetorno(200, 'Sucesso');
    }
    
    public function deletarProduto(array $parametros): array
    {
        foreach ($parametros['parametros'] as $valor) {
            $this->model->deletarProduto($valor);
        }
        return Common::prepararRetorno(200, 'Sucesso');
    }
}