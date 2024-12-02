<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

// Middleware de error
$app->addErrorMiddleware(true, true, true);

// Cargar rutas
(require 'src/routes.php')($app);

$app->run(); 
