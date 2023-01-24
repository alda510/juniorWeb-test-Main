<?php

namespace backAlda\Src\Models\Produtos;

use backAlda\Src\Models\Model;

use PDO;

class ModelProdutos extends Model
{
    public function listarProdutos(): array
    {
        $query = $this->conexaoPdo->query('SELECT * FROM elementos');
        return $query->fetchAll( PDO::FETCH_ASSOC );
    }

    public function listarLivros()
    {
        $query = $this->conexaoPdo->query('SELECT * FROM livros');
        return $query->fetchAll( PDO::FETCH_ASSOC );
    }

    public function listarDvds(): array
    {
        $query = $this->conexaoPdo->query('SELECT * FROM dvds');
        return $query->fetchAll( PDO::FETCH_ASSOC );
    }

    public function listarFurniture(): array
    {
        $query = $this->conexaoPdo->query('SELECT * FROM furniture');
        return $query->fetchAll( PDO::FETCH_ASSOC );
    }

    public function cadastrarProduto(array $parametros)
    {
        $query = 'INSERT INTO elementos (sku, nome, valor, tipo) VALUES (:sku, :nome, :valor, :tipo)';
        $stmt = $this->conexaoPdo->prepare($query);
        $stmt->execute($parametros);
    }

    public function cadastrarLivro(array $parametros)
    {
        $query = 'INSERT INTO livros (sku, peso) VALUES (:sku, :peso)';
        $stmt = $this->conexaoPdo->prepare($query);
        $stmt->execute($parametros);
    }

    public function cadastrarDvd(array $parametros)
    {
        $query = 'INSERT INTO dvds (sku, tamanho) VALUES (:sku, :tamanho)';
        $stmt = $this->conexaoPdo->prepare($query);
        $stmt->execute($parametros);
    }

    public function cadastrarFurniture(array $parametros): void
    {
        $query = 
        'INSERT INTO 
            furniture (sku, largura, altura, comprimento) 
        VALUES 
            (:sku, :largura, :altura, :comprimento)';
        $stmt = $this->conexaoPdo->prepare($query);
        $stmt->execute($parametros);
    }

    public function deletarProduto($parametros)
    {
        $tabelas = [
            'elementos',
            'livros',
            'dvds',
            'furniture',
        ];
        $this->conexaoPdo->beginTransaction();

        foreach ($tabelas as $tabela) {
            $query = "DELETE FROM $tabela WHERE sku = :sku";
            $stmt = $this->conexaoPdo->prepare($query);
            $stmt->execute($parametros);
        }

        $this->conexaoPdo->commit();
    }
}