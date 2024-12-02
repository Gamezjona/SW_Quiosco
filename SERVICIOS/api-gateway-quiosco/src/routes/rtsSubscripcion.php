<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

//*****GET*****/
// /subscripciones
// /subscripciones/<int:id>

/*****POST****/
//subscripciones
/**
{
        "estatus": 0,
        "id": 4,
        "sub": "Free"
}
*/

//******PUT******/
// /subscripciones/status/<int:id>
/**
{
    "sub": "",
    "estatus": 0,
}
*/

/**DELETE */
// /subscripciones/<int:id>


return Function($app,$client){

    $app->get('/SWSubscripciones', function (Request $request, Response $response) use ($client) {
        try {
            // Realiza la solicitud al servicio REST
            $apiResponse = $client->request('GET', 'https://ws-api-pythom-latest.onrender.com');

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

    $app->get('/SWSubscripciones/VerTodo', function (Request $request, Response $response) use ($client) {
        try {
            // Realiza la solicitud al servicio REST
            $apiResponse = $client->request('GET', 'https://ws-api-pythom-latest.onrender.com/subscripciones');
    
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

    $app->get('/SWSubscripciones/BuscarId/{id}', function (Request $request, Response $response, array $args) use ($client) {
        try {
            // Extraer el parámetro 'id' de los argumentos
            $id = $args['id'];
    
            // Realiza la solicitud al servicio REST usando el ID dinámico
            $apiResponse = $client->request('GET', "https://ws-api-pythom-latest.onrender.com/subscripciones/".$id);
    
            // Obtén el contenido del cuerpo de la respuesta y conviértelo a una cadena
            $responseBody = $apiResponse->getBody()->getContents();
    
            // Escribe el contenido de la respuesta en el cuerpo de la respuesta
            $response->getBody()->write($responseBody);
    
            // Configura el encabezado de respuesta para indicar que es JSON
            return $response->withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            // En caso de error, devuelve un mensaje de error en formato JSON
            $response->getBody()->write(json_encode(['message' => "Usuario no encontrado"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    });

    $app->post('/SWSubscripciones/Nuevo', function (Request $request, Response $response) use ($client) {
        try {
            $body = $request->getBody()->getContents();
    
            $data = json_decode($body, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Error al decodificar el JSON: " . json_last_error_msg());
            }
    
            $apiResponse = $client->request('POST', 'https://ws-api-pythom-latest.onrender.com/subscripciones', [
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

    $app->put('/SWSubscripciones/Editar/{id}', function (Request $request, Response $response, array $args) use ($client) {
        try {
            // Obtener el cuerpo de la solicitud
            $body = $request->getBody()->getContents();
        
            // Decodificar el cuerpo de la solicitud (JSON)
            $data = json_decode($body, true);
        
            // Verificar si hay errores en la decodificación del JSON
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Error al decodificar el JSON: " . json_last_error_msg());
            }
    
            // Obtener el parámetro {id} de la URL
            $id = $args['id'];
    
            // Realizar la solicitud PUT al microservicio de contenido, reemplazando {id}
            $apiResponse = $client->request('PUT', 'https://ws-api-pythom-latest.onrender.com/subscripciones/status/' . $id, [
                'json' => $data 
            ]);
        
            // Obtener el cuerpo de la respuesta de la API
            $responseBody = $apiResponse->getBody()->getContents();
        
            // Escribir la respuesta en el cuerpo de la respuesta
            $response->getBody()->write($responseBody);
        
            // Retornar la respuesta con el encabezado adecuado
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            // En caso de error, retornar un mensaje de error
            $response->getBody()->write(json_encode(['message' => 'Usuario no encontrado']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    });

    $app->delete('/SWSubscripciones/EliminarId/{id}', function (Request $request, Response $response, array $args) use ($client) {  
        try {
    
            $id = $args['id'];
    
            $apiResponse = $client->request('delete', "https://ws-api-pythom-latest.onrender.com/subscripciones/$id");
    
            $responseBody = $apiResponse->getBody()->getContents();
    
            $response->getBody()->write($responseBody);
    
            return $response->withHeader('Content-Type', 'application/json');
    
        } catch (Exception $e) {
    
            $response->getBody()->write(json_encode(['error' => 'Usuario no encontrado']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    });

};
