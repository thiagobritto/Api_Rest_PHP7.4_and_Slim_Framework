<?php

namespace App\Controllers;

use \App\DAO\MySql\SysBshoes\TokensDAO;
use \App\DAO\MySql\SysBshoes\UsuariosDAO;
use \App\Models\MySql\SysBshoes\TokenModel;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

final class AuthController
{
  public function login( Request $request, Response $response, array $args ):Response
  {
    $data = $request->getParsedBody();
    $email = $data['email'];
    $senha = $data['senha'];
    $expire_date = $data['expire_date'];

    $usuariosDAO = new UsuariosDAO;
    $usuario = $usuariosDAO->getUserByEmail($email);

    if ( is_null($usuario) )
      return $response->withStatus(401);

    if ( !password_verify($senha, $usuario->getSenha()) )
      return $response->withStatus(401);

    $tokenPayload = [
      "sub" => $usuario->getId(),
      "name" => $usuario->getNome(),
      "email" => $usuario->getEmail(),
      "expired_at" => $expire_date
    ];
    $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

    $refreshTokenPayload = [
      "email" => $usuario->getEmail(),
      "random" => uniqid()
    ];
    $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));
    
    $tokenModel = new TokenModel;
    $tokenModel
      ->setExpired($expire_date)
      ->setRefreshToken($refreshToken)
      ->setToken($token)
      ->setUsuarioId($usuario->getId());

    $tokenDAO = new TokensDAO;
    $tokenDAO->createToken($tokenModel);

    $response = $response->withJson([
      "token" => $token,
      "refresh_token" => $refreshToken
    ]);
    
    return $response;
  }
  
  public function refreshToken( Request $request, Response $response, array $args ):Response
  {
    $data = $request->getParsedBody();
    $refresh_token = $data['refresh_token'];
    $expire_date = $data['expire_date'];

    $refresh_token_decode = JWT::decode($refresh_token, getenv("JWT_SECRET_KEY"), ['HS256']);

    $tokensDAO = new TokensDAO;
    $refresh_token_exists = $tokensDAO->verifyReshToken($refresh_token);
    
    if ( !$refresh_token_exists )
      return $response->withStatus(401);

    $usuariosDAO = new UsuariosDAO;
    $usuario = $usuariosDAO->getUserByEmail($refresh_token_decode->email);

    if ( is_null($usuario) )
      return $response->withStatus(401);
    
    $tokenPayload = [
      "sub" => $usuario->getId(),
      "name" => $usuario->getNome(),
      "email" => $usuario->getEmail(),
      "expired_at" => $expire_date
    ];
    $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

    $refreshTokenPayload = [
      "email" => $usuario->getEmail(),
      "random" => uniqid()
    ];
    $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));
    
    $tokenModel = new TokenModel;
    $tokenModel
      ->setExpired($expire_date)
      ->setRefreshToken($refreshToken)
      ->setToken($token)
      ->setUsuarioId($usuario->getId());
  
    $tokenDAO = new TokensDAO;
    $tokenDAO->createToken($tokenModel);
  
    $response = $response->withJson([
      "token" => $token,
      "refresh_token" => $refreshToken
    ]);
      
    return $response;
  }
}