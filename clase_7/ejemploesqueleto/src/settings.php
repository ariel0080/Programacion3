<?php
return [ //aca va la configuracion de la base de datos
    'settings' => [
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
        'logger-error' => [
            'name' => 'slim-app-error',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/error.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        //seteo de la base de datos
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'cdcol',
            'username' => 'root',
            'password' => '',
            'charset'  => 'utf8',
            'collation'=> 'utf8_unicode_ci',
            'prefix'   => '',
        ],
    ],
];
