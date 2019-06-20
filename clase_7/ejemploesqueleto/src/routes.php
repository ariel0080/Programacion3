<?php
//aca es donde se comunica con el exterior, por default viene el get
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\cd; //utiliza un namespace

include_once __DIR__ . '/../src/app/cd.php';

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        $container->get('logger-error')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get('/error/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger-error')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
    $app->post('/error/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger-error')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
    $app->put('/error/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger-error')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
    $app->delete('/error/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger-error')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
    $app->group('/cdORM', function () {   
         
        $this->get('/', function ($request, $response, $args) {
          //return cd::all()->toJson();
          $todosLosCds=cd::all();
          $newResponse = $response->withJson($todosLosCds, 200);  
          return $newResponse;
        });
    });
};
