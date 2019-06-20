<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

include_once __DIR__ . '/app/';

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

        $this->get('/Consultas', function ($request, $response, $args) {
          //return cd::all()->toJson();
      /*     $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */
        });
        $this->post('/Alta', function ($request, $response, $args) {
          //return cd::all()->toJson();
      /*     $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */
        });
        $this->post('/Modificaciones', function ($request, $response, $args) {
          //return cd::all()->toJson();
      /*   $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */
        });
        $this->post('/Baja', function ($request, $response, $args) {
          //return cd::all()->toJson();
      /*     $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);
          return $newResponse; */
        });
    });







};
