<?php

namespace App\Models\MySql\SysBshoes;

final class TokenModel
{
  private int $id;
  private string $token;
  private string $refresh_token;
  private string $expired_at;
  private int $usuario_id;
  
  public function getId():int
  {
    return (int) $this->id;
  }
  public function setId( int $id ):TokenModel
  {
    $this->id = (int) $id;
    return $this;
  }

  public function getToken():string
  {
    return (string) $this->token;
  }
  public function setToken( string $token ):TokenModel
  {
    $this->token = (string) $token;
    return $this;
  }

  public function getRefreshToken():string
  {
    return (string) $this->refresh_token;
  }
  public function setRefreshToken( string $refresh_token ):TokenModel
  {
    $this->refresh_token = (string) $refresh_token;
    return $this;
  }

  public function getExpired():string
  {
    return (string) $this->expired_at;
  }
  public function setExpired( string $expired_at ):TokenModel
  {
    $this->expired_at = (string) $expired_at;
    return $this;
  }

  public function getUsuarioId():int
  {
    return (int) $this->usuario_id;
  }
  public function setUsuarioId( int $usuario_id ):TokenModel
  {
    $this->usuario_id = (int) $usuario_id;
    return $this;
  }
}