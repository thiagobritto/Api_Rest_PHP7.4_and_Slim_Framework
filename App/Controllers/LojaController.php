<?php

namespace App\Controllers;

use \App\DAO\MySql\SysBshoes\LojasDAO;
use \App\Models\MySql\SysBshoes\LojaModel;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class LojaController
{
  public function getLoja( Request $request, Response $response, array $args ):Response
  {
    $lojasDAO = new LojasDAO;
    $lojas = $lojasDAO->getAllLojas();
    $response = $response->withJson($lojas);
    return $response;
  }
  public function insertLoja( Request $request, Response $response, array $args ):Response
  {
    $data = $request->getParsedBody();

    $lojasDAO = new LojasDAO;
    $loja = new LojaModel;
    $loja->setNome($data['nome'])
      ->setEndereco($data['endereco'])
      ->setTelefone($data['telefone']);
    $lojasDAO->insertLoja($loja);

    $response = $response->withJson([
      "Message" => "Loja inserida com sucesso!"
    ]);
    return $response;
  }
  public function updateLoja( Request $request, Response $response, array $args ):Response
  {
    $data = $request->getParsedBody();
    $id = $request->getHeader("Authorization")[0];
    
    $lojasDAO = new LojasDAO;
    $loja = new LojaModel;
    $loja
      ->setNome($data['nome'])
      ->setEndereco($data['endereco'])
      ->setTelefone($data['telefone']);
    $lojasDAO->updateLoja($loja, $id);

    $response = $response->withJson([
      "Message" => "Loja atualizada com sucesso!"
    ]);
    return $response;
  }
  public function deleteLoja( Request $request, Response $response, array $args ):Response
  {
    $id = $request->getHeader("Authorization")[0];

    $lojaDAO = new LojasDAO;
    $lojaDAO->deleteLoja($id);
    
    $response = $response->withJson([
      "Message" => "Loja excluida com sucesso!"
    ]);
    return $response;
  }
}