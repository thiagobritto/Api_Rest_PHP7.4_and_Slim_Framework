<?php

namespace App\Models\MySql\SysBshoes;

final class ProdutoModel
{
  private int $id;
  private int $id_loja;
  private string $nome;
  private float $preco;
  private int $quantidade;

  public function getId():int
  {
    return $this->id;
  }

  public function setIdLoja( int $id_loja ):ProdutoModel
  {
    $this->id_loja = $id_loja;
    return $this;
  }
  public function getIdLoja():int
  {
    return $this->id_loja;
  }
  
  public function setNome( string $nome ):ProdutoModel
  {
    $this->nome = $nome;
    return $this;
  }
  public function getNome():string
  {
    return $this->nome;
  }

  public function setPreco( float $preco ):ProdutoModel
  {
    $this->preco = $preco;
    return $this;
  }
  public function getPreco():float
  {
    return $this->preco;
  }

  public function setQuantidade( int $quantidade ):ProdutoModel
  {
    $this->quantidade = $quantidade;
    return $this;
  }
  public function getQuantidade():int
  {
    return $this->quantidade;
  }
}