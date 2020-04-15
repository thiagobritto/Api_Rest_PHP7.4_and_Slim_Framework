<?php

use function src\{
  jwtAuth,
  basicAuth,
  slimConfiguration
};
use App\Controllers\{
  AuthController,
  LojaController,
  ProdutoController,
  ExceptionController
};
use App\Middlewares\JwtDateTimeMiddleware;

$app = new \Slim\App( slimConfiguration() );
// ===========================================

$app->group("/v1", function() use($app){
  $app->get("/teste-verssion", function($requet, $response, $args){
    return "oi v1";
  });
});

$app->group("/v2", function() use($app){
  $app->get("/teste-verssion", function($requet, $response, $args){
    return "oi v2";
  });
});

$app->get( "/teste2", ExceptionController::class . ":teste" );

$app->post( "/login", AuthController::class . ":login" );
$app->post( "/refresh-token", AuthController::class . ":refreshToken" );

$app->get( "/teste", function(){ echo"oi"; } )
  ->add(new JwtDateTimeMiddleware)
  ->add(jwtAuth());

$app->group('', function() use($app) {
  $app->get   ( "/loja", LojaController::class . ":getLoja"    );
  $app->post  ( "/loja", LojaController::class . ":insertLoja" );
  $app->put   ( "/loja", LojaController::class . ":updateLoja" );
  $app->delete( "/loja", LojaController::class . ":deleteLoja" );

  $app->get   ( "/produto", ProdutoController::class . ":getProdutos"    );
  $app->post  ( "/produto", ProdutoController::class . ":insertProdutos" );
  $app->put   ( "/produto", ProdutoController::class . ":updateProdutos" );
  $app->delete( "/produto", ProdutoController::class . ":deleteProdutos" );
})->add( basicAuth() );

// ===========================================
$app->run();