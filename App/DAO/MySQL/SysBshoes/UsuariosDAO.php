<?php

namespace App\DAO\MySql\SysBshoes;

use App\Models\MySql\SysBshoes\LojaModel;
use App\Models\MySql\SysBshoes\UsuarioModel;

class UsuariosDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct(); 
  }

  public function getUserByEmail( string $email ): ? UsuarioModel
  {
    $stmt = $this->pdo->prepare("SELECT
      id,
      email,
      nome,
      senha
     FROM usuarios WHERE
      email = :EMAIL 
    ");

    $stmt->bindParam(":EMAIL", $email);
    $stmt->execute();
    $usuarios = $stmt->fetch(\PDO::FETCH_ASSOC);
    
    if ($usuarios):
      $usuario = new UsuarioModel;
      $usuario
        ->setId($usuarios['id'])
        ->setNome($usuarios['nome'])
        ->setEmail($usuarios['email'])
        ->setSenha($usuarios['senha']);
      return $usuario;
    endif;
    
    return null;
  }
}