<?php

namespace App\Models\MySql\SysBshoes;

final class UsuarioModel
{
  private int $id;
  private string $nome;
  private string $email;
  private string $senha;

  public function getId():int
  {
    return (int) $this->id;
  }
  public function setId( int $id ):UsuarioModel
  {
    $this->id = (int) $id;
    return $this;
  }

  public function getNome():string
  {
    return (string) $this->nome;
  }
  public function setNome( string $nome ):UsuarioModel
  {
    $this->nome = (string) $nome;
    return $this;
  }

  public function getEmail():string
  {
    return (string) $this->email;
  }
  public function setEmail( string $email ):UsuarioModel
  {
    $this->email = (string) $email;
    return $this;
  }

  public function getSenha():string
  {
    return (string) $this->senha;
  }
  public function setSenha( string $senha ):UsuarioModel
  {
    $this->senha = (string) $senha;
    return $this;
  }
}
