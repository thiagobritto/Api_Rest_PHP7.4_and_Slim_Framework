<?php

namespace App\Controllers;

use \App\DAO\MySql\SysBshoes\ProdutosDAO;
use \App\Models\MySql\SysBshoes\ProdutoModel;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ProdutoController
{
  public function getProdutos( Request $request, Response $response, array $args ):Response
  {
    $produtoDAO = new ProdutosDAO;
    $produtos = $produtoDAO->getAllProdutos();
    $response = $response->withJson($produtos);
    return $response;
  }
  public function insertProdutos( Request $request, Response $response, array $args ):Response
  {
    $data = $request->getParsedBody();

    $produtoDAO = new ProdutosDAO;
    $produto = new ProdutoModel;
    $produto
      ->setNome($data['nome'])
      ->setIdLoja($data['id_loja'])
      ->setPreco($data['preco'])
      ->setQuantidade($data['quantidade']);
    $produtoDAO->insertProdutos($produto);

    $response = $response->withJson([
      "Message" => "Produto inserido com sucesso!"
    ]);

    return $response;
  }

  public function updateProdutos( Request $request, Response $response, array $args ):Response
  {
    $data = $request->getParsedBody();
    $id = $request->getHeader("Authorization")[0];

    $produtosDAO = new ProdutosDAO;
    $produto = new ProdutoModel;
    $produto
      ->setNome($data['nome'])
      ->setIdLoja($data['id_loja'])
      ->setPreco($data['preco'])
      ->setQuantidade($data['quantidade']);
    $produtosDAO->updateProdutos($produto, $id);

    $response = $response->withJson([
      "Message" => "Produto editade com sucesso!"
    ]);

    return $response;
  }
  
  public function deleteProdutos( Request $request, Response $response, array $args ):Response
  {
    $id = $request->getHeader("Authorization")[0];
    
    $produtoDAO = new ProdutosDAO;
    $produtoDAO->deleteProdutos($id);

    $response = $response->withJson([
      "Message" => "Produto excluido com sucesso!"
    ]);

    return $response;
  }
}