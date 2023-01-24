<?php

namespace backAlda\Src\Controllers\Produtos;

use backAlda\Src\Models\Produtos\ModelProdutos;
use backAlda\Resources\Common\Common;

class Produtos
{
    private $model;
    
    private function trabalharPropriedade(array $propriedades): array
    {
        if (count($propriedades) > 1) {
            foreach ($propriedades as $chave => $valor) {
                $propriedades[$chave] = $valor/100;
            }
            return ['dimensions' => implode('x', $propriedades)];
        }
        return [array_key_first($propriedades) => $propriedades[array_key_first($propriedades)]/100];
    }

    private function cadastrarLivros(array $produto): void
    {
        $produto['peso'] = $produto['peso'] * 100;
        $this->model->cadastrarLivro($produto);
    }

    private function cadastrarDvds(array $produto): void
    {
        $produto['tamanho'] = $produto['tamanho'] * 100;
        $this->model->cadastrarDvd($produto);
    }

    private function cadastrarFurniture(array $produto): void
    {
        $produto['largura'] = $produto['largura'] * 100;
        $produto['altura'] = $produto['altura'] * 100;
        $produto['comprimento'] = $produto['comprimento'] * 100;
        $this->model->cadastrarFurniture($produto);
    }

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
        $propriedades = array_merge($livros, $dvds, $furniture);
        foreach ($produtos as $chave => $valor) {
            $produtos[$chave]['valor'] = $valor['valor']/100;
            foreach ($propriedades as $prop) {
                if ($prop['sku'] === $valor['sku']) {
                    unset($prop['sku']);
                    $propriedade =  $this->trabalharPropriedade($prop);
                    $produtos[$chave]['properties'] = $propriedade;
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
        $this->model->cadastrarProduto($produto);
        $metodo = 'cadastrar' . ucfirst($parametros['tipo']);
        unset($parametros['tipo']);
        $this->$metodo($parametros);
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