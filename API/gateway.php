<?php

function verTodoContenido()
{
    // URL del servicio web
    $url = "https://ws-api-gateway-latest.onrender.com/SWContenido/VerTodo";

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($ch);

    // Verificar si hubo errores
    if (curl_errno($ch)) {
        echo 'Error de cURL: ' . curl_error($ch);
        exit;
    }

    // Cerrar la sesión de cURL
    curl_close($ch);

    // Decodificar el JSON recibido
    $data = json_decode($response, true);

    return $data;
}

function nuevoContenido($titulo, $categoria, $descripcion, $enlace, $imgUrl)
{
    $url = "https://ws-api-gateway-latest.onrender.com/SWContenido/Nuevo";

    // Crear el array de datos
    $data = [
        "titulo" => $titulo,
        "categoria" => $categoria,
        "descripcion" => $descripcion,
        "imagen" => $imgUrl,
        "enlace" => $enlace
    ];

    // Codificar los datos en JSON
    $jsonData = json_encode($data);

    // Iniciar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_POST, true); // Método POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Datos a enviar
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // Tipo de contenido
        'Content-Length: ' . strlen($jsonData) // Longitud del contenido
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar la respuesta como string

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Manejo de errores
    if ($response === false) {
        die('Error en cURL: ' . curl_error($ch));
    }

    // Cerrar la conexión cURL
    curl_close($ch);

    // Mostrar la respuesta del servidor
    echo "Respuesta del servidor: " . $response;
}

function eliminarContenido($id)
{
    // URL del servicio web con el ID del patrocinador
    $url = "https://ws-api-gateway-latest.onrender.com/SWContenido/EliminarId/" . $id;

    // Iniciar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL para el método DELETE
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Método DELETE
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar la respuesta como string

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Manejo de errores
    if ($response === false) {
        die('Error en cURL: ' . curl_error($ch));
    }

    // Cerrar la conexión cURL
    curl_close($ch);

    // Devolver la respuesta del servidor
    //return $response;
}

function nuevoSubscriptor($id)
{
    $url = "https://ws-api-gateway-latest.onrender.com/SWSubscripciones/Nuevo";

    // Datos a enviar en la petición POST
    $data = array(
        'id' => $id,
        'estatus' => 1,
        'sub' => 'Free'
    );

    // Codificar los datos en formato JSON
    $data_json = json_encode($data);

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar el resultado como string
    curl_setopt($ch, CURLOPT_POST, true); // Indicar que es una petición POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); // Datos a enviar
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', // Encabezado indicando que los datos son JSON
        'Content-Length: ' . strlen($data_json) // Longitud del contenido
    ));

    // Ejecutar la petición y obtener la respuesta
    $response = curl_exec($ch);

    // Manejo de errores
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        //echo 'Respuesta: ' . $response;
    }

    // Cerrar cURL
    curl_close($ch);
}

function setSubscriptor($id, $estatus, $sub)
{
    // URL de la API, asegurándonos de que $id esté bien integrado en la URL
    $url = "https://ws-api-gateway-latest.onrender.com/SWSubscripciones/Editar/" . urlencode($id);

    // Datos a enviar en la petición PUT
    $data = array(
        "sub" => $sub,
        "estatus" => $estatus
    );

    // Codificar los datos en formato JSON
    $data_json = json_encode($data);

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar el resultado como string
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Especificar el método como PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); // Datos a enviar en el cuerpo
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', // Encabezado indicando que los datos son JSON
        'Content-Length: ' . strlen($data_json) // Longitud del contenido
    ));

    // Ejecutar la petición y obtener la respuesta
    $response = curl_exec($ch);

    // Manejo de errores
    if (curl_errno($ch)) {
        curl_close($ch);
        echo 'Error: ' . curl_error($ch);
    } else {

        curl_close($ch);
        // Si la solicitud fue exitosa, redirigir a usuarios.php
        //header("Location: ../View/usuarios.php");
        echo $response;
        //echo $id.$estatus.$sub;
        //exit; // Asegurarse de que no siga ejecutándose el código después de la redirección
    }
}

function eliminarSubscriptor($id)
{
    $url = "https://ws-api-gateway-latest.onrender.com/SWSubscripciones/EliminarId/" . urlencode($id);

    // Datos a enviar en la petición DELETE
    $data = array(
        'estatus' => 1,
        'sub' => 'Free'
    );

    // Codificar los datos en formato JSON
    $data_json = json_encode($data);

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar el resultado como string
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Usar DELETE en lugar de POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); // Enviar los datos
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', // Indicar que los datos son JSON
        'Content-Length: ' . strlen($data_json) // Longitud del contenido
    ));

    // Ejecutar la petición y obtener la respuesta
    $response = curl_exec($ch);

    // Manejo de errores en cURL
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        curl_close($ch);
        return;
    } else {
        // Cerrar la conexión cURL
        curl_close($ch);


        // Conexión a la base de datos con mysqli
        $host = 'db4free.net';
        $username = 'swquioscojonas';
        $password = 'sebas1379';
        $dbname = 'swquioscoprueb';

        // Crear la conexión
        $conn = new mysqli($host, $username, $password, $dbname);

        // Comprobar si la conexión fue exitosa
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Asegúrate de validar el valor de 'id' para evitar inyecciones de SQL

        // Preparar la consulta para eliminar el usuario
        $sql = "DELETE FROM usuarios WHERE id = ?";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        // Vincular el parámetro (id) a la consulta
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // echo "Usuario eliminado correctamente.";
        } else {
            echo "Error al eliminar el usuario: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conn->close();
    }
}

function verTodosPatrocinador()
{
    // URL del endpoint de la API
    $apiUrl = "https://ws-api-gateway-latest.onrender.com/SWPatrocinador/VerTodo";

    // Inicializar cURL para obtener la lista de patrocinadores
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    return $data;
}

function nuevoPatrocinador($nombre, $giro)
{
    // URL del servicio web
    $url = "https://ws-api-gateway-latest.onrender.com/SWPatrocinador/Nuevo";

    // Datos a enviar en el POST
    $data = [
        "nombre" => $nombre,
        "giro" => $giro
    ];

    // Codificar los datos en formato JSON
    $jsonData = json_encode($data);

    // Iniciar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_POST, true); // Método POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Datos a enviar
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // Tipo de contenido
        'Content-Length: ' . strlen($jsonData) // Longitud del contenido
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar la respuesta como string

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Manejo de errores
    if ($response === false) {
        die('Error en cURL: ' . curl_error($ch));
    }

    // Cerrar la conexión cURL
    curl_close($ch);

    // Mostrar la respuesta del servidor
    //echo "Respuesta del servidor: " . $response;
}

function eliminarPatrocinador($id)
{
    // URL del servicio web con el ID del patrocinador
    $url = "https://ws-api-gateway-latest.onrender.com/SWPatrocinador/EliminarId/" . $id;

    // Iniciar cURL
    $ch = curl_init($url);

    // Configurar las opciones de cURL para el método DELETE
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Método DELETE
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar la respuesta como string

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Manejo de errores
    if ($response === false) {
        die('Error en cURL: ' . curl_error($ch));
    }

    // Cerrar la conexión cURL
    curl_close($ch);

    // Devolver la respuesta del servidor
    //return $response;
}