<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Client;

return function ($app) {

    $client = new Client();

    $app->get('/', function (Request $request, Response $response, array $args) use ($client) {
        $data = ["Servico" => "API GateWay"];
        $response = $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
        $response->getBody()->write(json_encode($data));
        return $response;
    });

    // Redirección al Microservicio de Patrocinador
    (require 'src/routes/rtsPatrocinador.php')($app, $client);

    // Redirección al Microservicio de Contenido
    (require 'src/routes/rtsContenido.php')($app, $client);

    //Redireccion al Microservidor de Subscripciones

    (require 'src/routes/rtsSubscripcion.php')($app,$client);

    // Ruta para manejar errores desconocidos
    $app->map(['GET', 'POST', 'PUT', 'DELETE'], '/{routes:.+}', function (Request $request, Response $response) {
        // Usando json_encode para enviar la respuesta en formato JSON
        $response->getBody()->write(json_encode(['error' => 'Ruta no encontrada']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    });
};
