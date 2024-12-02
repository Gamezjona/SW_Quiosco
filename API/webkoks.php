<?php
function nuevoUsuario($email,$idUser) {
    $url = "https://hook.us2.make.com/5r0bv3l8u5k3okr4l0vsbbc5u4emmq26";

    $data = array(
        "to" => $email,
        "subject" => "BIENVENIDO AL QUIOSCO DIJITAL",
        "message" => "Te damos la bienvenida a nuestra Aplicaion Web EL QUIOSCO DIGITAL",
        "msjAdmin" => "Un nuevo usuario con id:".$idUser." y email:".$email
    );

    $data_json = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json)
    ));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
       // echo 'Respuesta: ' . $response;
    }

    curl_close($ch);
}



function nuevoPlan($email,$plan) {
    $url = "https://hook.us2.make.com/sbqfglqvgspuhcz06yft3a17vqoxm322";

    $data = array(
        "to" => $email,
        "subject" => "QUIOSCO DIJITAL NUEVO PLAN",
        "message" => "Ahora tu plan es: ".$plan,
        "msjAdmin" => "El Usuario ".$email." ahora es: ".$plan
    );

    $data_json = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json)
    ));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
       // echo 'Respuesta: ' . $response;
    }

    curl_close($ch);
}
?>
