<?php

namespace App\Controllers;

use App\Exceptions\TesteException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ExceptionController
{
  public function teste( Request $request, Response $response, array $args )
  {
    try {

      throw new TesteException("Faltou enviar uma senha");
      return $response->getBody()->write("ok");
    
    } catch ( TesteException $e ) {
      return $response->withJson([
        "error" => TesteException::class,
        "status" => 400,
        "code" => 003,
        "userMessage" => "Teste de classe de erro",
        "developerMessage" => [
          "msgError" => $e->getMessage(),
          "code" => $e->getCode(),
          "file" => $e->getFile(),
          "line" => $e->getLine()
        ]
      ], 400);
    } catch ( \InvalidArgumentException $e ) {
      return $response->withJson([
        "error" => \InvalidArgumentException::class,
        "status" => 400,
        "code" => 002,
        "userMessage" => "É necessario enviar todos os dados para o login",
        "developerMessage" => [
          "msgError" => $e->getMessage(),
          "code" => $e->getCode(),
          "file" => $e->getFile(),
          "line" => $e->getLine()
        ]
      ], 400);
    } catch ( \Exception | \Throwable $e ) { //Throwable
      
      return $response->withJson([
        "error" => \Exception::class,
        "status" => 500,
        "code" => 001,
        "userMessage" => "Erro na aplicação entre em comtato com o administrador do systema!",
        "developerMessage" => [
          "msgError" => $e->getMessage(),
          "code" => $e->getCode(),
          "file" => $e->getFile(),
          "line" => $e->getLine()
        ]
      ], 500);
    }
    
  }
}