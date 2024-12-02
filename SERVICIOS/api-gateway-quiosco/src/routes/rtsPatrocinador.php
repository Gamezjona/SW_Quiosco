<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


    //******GET*******
    // patrocinador TODOS los patrocinadores
    // patrocinador/{id}
    // patrocinador/query?giro="Tecnologia"

    //***POST Y PUT***
    // patrocinador/new
    /**
    {
        "id":"", este se agrea si se quiere crear o editar
        "nombre":"",
        "giro":""   
    }
    */

    //***DETLETE****
    // patrocinador{id}

return function ($app,$client){

$app->get('/SWPatrocinador', function (Request $request, Response $response) use ($client) {
    try {
        // Realiza la solicitud al servicio REST
        $apiResponse = $client->request('GET', 'https://ws-rest-mysql-0-0-1-snapshot-latest.onrender.com');

        // Obtén el contenido del cuerpo de la respuesta (stream), y conviértelo a una cadena
        $responseBody = $apiResponse->getBody()->getContents();

        // Escribe el contenido de la respuesta en el cuerpo de la respuesta
        $response->getBody()->write($responseBody);

        // Configura el encabezado de respuesta para indicar que es JSON
        return $response->withHeader('Content-Type', 'application/json');
    } catch (Exception $e) {
        // En caso de error, devuelve un mensaje de error en formato JSON
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->get('/SWPatrocinador/VerTodo', function (Request $request, Response $response) use ($client) {
    try {
        // Realiza la solicitud al servicio REST
        $apiResponse = $client->request('GET', 'https://ws-rest-mysql-0-0-1-snapshot-latest.onrender.com/patrocinador');

        // Obtén el contenido del cuerpo de la respuesta (stream), y conviértelo a una cadena
        $responseBody = $apiResponse->getBody()->getContents();

        // Escribe el contenido de la respuesta en el cuerpo de la respuesta
        $response->getBody()->write($responseBody);

        // Configura el encabezado de respuesta para indicar que es JSON
        return $response->withHeader('Content-Type', 'application/json');
    } catch (Exception $e) {
        // En caso de error, devuelve un mensaje de error en formato JSON
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->get('/SWPatrocinador/BuscarId/{id}', function (Request $request, Response $response, array $args) use ($client) {
    try {
        // Extraer el parámetro 'id' de los argumentos
        $id = $args['id'];

        // Realiza la solicitud al servicio REST usando el ID dinámico
        $apiResponse = $client->request('GET', "https://ws-rest-mysql-0-0-1-snapshot-latest.onrender.com/patrocinador/$id");

        // Obtén el contenido del cuerpo de la respuesta y conviértelo a una cadena
        $responseBody = $apiResponse->getBody()->getContents();

        // Escribe el contenido de la respuesta en el cuerpo de la respuesta
        $response->getBody()->write($responseBody);

        // Configura el encabezado de respuesta para indicar que es JSON
        return $response->withHeader('Content-Type', 'application/json');
    } catch (Exception $e) {
        // En caso de error, devuelve un mensaje de error en formato JSON
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->get('/SWPatrocinador/BuscarGiro', function (Request $request, Response $response, array $args) use ($client) {
    try {
        // Extraer el parámetro 'giro' de la consulta (query string)
        $giro = $request->getQueryParams()['giro'] ?? null;

        // Verifica que el parámetro 'giro' no esté vacío
        if (!$giro) {
            throw new Exception("El parámetro 'giro' es obligatorio.");
        }

        // Realiza la solicitud al servicio REST con el parámetro 'giro'
        $apiResponse = $client->request('GET', "https://ws-rest-mysql-0-0-1-snapshot-latest.onrender.com/patrocinador/query", [
            'query' => ['giro' => $giro]
        ]);

        // Obtén el contenido del cuerpo de la respuesta y conviértelo a una cadena
        $responseBody = $apiResponse->getBody()->getContents();

        // Escribe el contenido de la respuesta en el cuerpo de la respuesta
        $response->getBody()->write($responseBody);

        // Configura el encabezado de respuesta para indicar que es JSON
        return $response->withHeader('Content-Type', 'application/json');
    } catch (Exception $e) {
        // En caso de error, devuelve un mensaje de error en formato JSON
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

//Este sirve para editar tambien
$app->post('/SWPatrocinador/Nuevo', function (Request $request, Response $response) use ($client) {
    try {
        $body = $request->getBody()->getContents();

        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al decodificar el JSON: " . json_last_error_msg());
        }

        $apiResponse = $client->request('POST', 'https://ws-rest-mysql-0-0-1-snapshot-latest.onrender.com/patrocinador/new', [
            'json' => $data 
        ]);

        $responseBody = $apiResponse->getBody()->getContents();

        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (Exception $e) {
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->delete('/SWPatrocinador/EliminarId/{id}', function (Request $request, Response $response, array $args) use ($client) {
    try {

        $id = $args['id'];

        $apiResponse = $client->request('delete', "https://ws-rest-mysql-0-0-1-snapshot-latest.onrender.com/patrocinador/$id");

        $responseBody = $apiResponse->getBody()->getContents();

        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json');

    } catch (Exception $e) {

        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});


};