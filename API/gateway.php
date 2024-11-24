<?php

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
