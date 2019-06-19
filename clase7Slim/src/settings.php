<?php


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

return [
    'settings' => [

        //CONFIGURACION PARA BASES DE DATOS


        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'errorlogger' => [
            'name' => 'slim-error',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/error.log',
            'level' => \Monolog\Logger::DEBUG,
        ],


        'db' => [
            'driver' => 'mysql',
             'host' => 'localhost',
             'database' => 'cdcol',
             'username' => 'root',
             'password' => '',
             'charset'   => 'utf8',
             'collation' => 'utf8_unicode_ci',
             'prefix'    => '',
         ],

        /*  $config['db']= [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'cdcol',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
         ], */

    ],
];
