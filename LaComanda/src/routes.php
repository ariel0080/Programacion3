<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

include_once __DIR__ . '/app/comanda.php';

return function (App $app) {
  $container = $app->getContainer();

  $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
    // Sample log message
    $container->get('logger')->info("Slim-Skeleton '/' route");

    // Render index view
    return $container->get('renderer')->render($response, 'index.phtml', $args);
  });


  /////////////////////////////77
  $app->group('/Pedidos', function () {

    $this->get('/', function ($request, $response, $args) {

      $arrayDatos = $args[key($_GET)];
      
      $response->getBody()->write("GET => ESTA");
      return $response;
    });
    $this->post('/', function ($request, $response, $args) {
      $response->getBody()->write("POST => ESTA");
      //return cd::all()->toJson();
      /*     $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */ });
    $this->put('/', function ($request, $response, $args) {
      //return cd::all()->toJson();
      /*   $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */ });
    $this->delete('/', function ($request, $response, $args) {
      //return cd::all()->toJson();
      /*     $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */ });
  });
};
