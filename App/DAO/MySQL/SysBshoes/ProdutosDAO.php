<?php

namespace App\DAO\MySql\SysBshoes;

use App\Models\MySql\SysBshoes\ProdutoModel;

class ProdutosDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct(); 
  }

  public function getAllProdutos():array
  {
    $produtos = $this->pdo
      ->query("SELECT * FROM produtos")
      ->fetchAll(\PDO::FETCH_ASSOC);
    return $produtos;
  }
  public function insertProdutos( ProdutoModel $produto ):void
  {
    $stmt = $this->pdo->prepare("INSERT INTO produtos (
      nome,
      id_loja,
      preco,
      quantidade
    ) VALUES(
      :NOME,
      :ID_LOJA,
      :PRECO,
      :QUANTIDADE
    );");

    $stmt->execute([
      ":NOME" => $produto->getNome(),
      ":ID_LOJA" => $produto->getIdLoja(),
      ":PRECO" => $produto->getPreco(),
      ":QUANTIDADE" => $produto->getQuantidade()
    ]);
  }

  public function updateProdutos( ProdutoModel $produto, int $id ):void
  {
    $stmt = $this->pdo->prepare("UPDATE produtos SET 
      nome = :NOME,
      id_loja = :ID_LOJA,
      preco = :PRECO,
      quantidade = :QUANTIDADE
    WHERE 
      id = :ID
    ;");

    $stmt->execute([
      ":NOME" => $produto->getNome(),
      ":ID_LOJA" => $produto->getIdLoja(),
      ":PRECO" => $produto->getPreco(),
      ":QUANTIDADE" => $produto->getQuantidade(),
      ":ID" => $id
    ]);
  }
  
  public function deleteProdutos( int $id ):void
  {
    $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :ID");
    $stmt->execute([
      ":ID" => $id
    ]);
  }

}