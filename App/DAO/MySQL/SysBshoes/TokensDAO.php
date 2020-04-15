<?php

namespace App\DAO\MySql\SysBshoes;

use App\Models\MySql\SysBshoes\TokenModel;

class TokensDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct(); 
  }

  public function createToken( TokenModel $token ):void
  {
    $stmt = $this->pdo->prepare("INSERT INTO tokens(
      token,
      refresh_token,
      expired_at,
      usuarios_id
    ) VALUES (
      :TOKEN,
      :REFRESH_TOKEN,
      :EXPIRED_AT,
      :USUARIOS_ID
    );");

    $stmt->execute([
      ":TOKEN" => $token->getToken(),
      ":REFRESH_TOKEN" => $token->getRefreshToken(),
      ":EXPIRED_AT" => $token->getExpired(),
      ":USUARIOS_ID" => $token->getUsuarioId()
    ]);
  }

  public function verifyReshToken( string $refresh_token ):bool
  {
    $stmt = $this->pdo->prepare(
        "SELECT 
          id 
        FROM 
          tokens 
        WHERE 
          refresh_token = :REFRESH_TOKEN"
      );
      $stmt->bindParam(":REFRESH_TOKEN", $refresh_token);
      $stmt->execute();
      $tokens = $stmt->fetch(\PDO::FETCH_ASSOC);
      return (!$tokens) ? false : true; 
  }
}