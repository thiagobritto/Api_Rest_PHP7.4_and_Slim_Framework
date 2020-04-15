<?php

namespace App\DAO\MySql\SysBshoes;

use App\Models\MySql\SysBshoes\LojaModel;

class LojasDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct(); 
  }
  public function getAllLojas():array
  {
    $lojas = $this
      ->pdo
      ->query("SELECT id, nome, telefone, endereco FROM lojas")
      ->fetchAll(\PDO::FETCH_ASSOC);
    return $lojas;
  }
  public function insertLoja( LojaModel $loja ):void
  {
    $stmt = $this->pdo->prepare("INSERT INTO lojas (
      nome, 
      telefone, 
      endereco
    ) VALUES (
      :NOME,
      :TELEFONE,
      :ENDERECO
    );");

    $stmt->execute([
      ":NOME" => $loja->getNome(),
      ":TELEFONE" => $loja->getTelefone(),
      ":ENDERECO" => $loja->getEndereco()
    ]);
  }
  public function updateLoja( LojaModel $loja, int $id ):void
  {
    $stmt = $this->pdo->prepare("UPDATE lojas SET 
      nome = :NOME,
      telefone = :TELEFONE,
      endereco =  :ENDERECO
    WHERE 
      id = :ID
    ;");

    $stmt->execute([
      ":NOME" => $loja->getNome(),
      ":TELEFONE" => $loja->getTelefone(),
      ":ENDERECO" => $loja->getEndereco(),
      ":ID" => $id
    ]);
  }
  public function deleteLoja( int $id ):void
  {
    $stmt = $this->pdo->prepare("DELETE FROM lojas WHERE id = :ID");
    $stmt->execute([
      ":ID" => $id
    ]);
  }
}