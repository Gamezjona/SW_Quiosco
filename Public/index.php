<?php

require '../Model/clases.php';

session_start(); // Reanuda la sesión


$userBool = false;


if (isset($_SESSION['id'])) {

    //echo "Bienvenido,  (Correo: " . $_SESSION['nombre']. ")";
    $userBool = true;

    //session_destroy();
} else {
    // Si no está autenticado, muestra el alert y redirige o maneja el flujo
    /* echo "
    <script src='../Source/JS/script.js'></script>
    <script>
        alertaUser(); // Llama a la función alertaUser() definida en script.js
        //window.location.href = '../View/login.html'; // Redirige después de mostrar la alerta
    </script>";
 */
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../Source/Css/bootstrap.min.css">
    <link rel="stylesheet" href="../Source/Css/styleIndex.css">
    <script src="../Source/JS/bootstrap.bundle.min.js"></script>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid d-ms-flex justify-content-around">

            <a class="navbar-brand" href="#">Navbar</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contenidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Patrocinadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Subscribcion</a>
                    </li>
                    <?php
                    if (!$userBool) {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='../View/login.html'>Iniciar Sesion</a>
                        </li>";


                        echo "<li class='nav-item'>
                        <a class='nav-link' href='../View/registro.html'>Registrarme</a>
                        </li>";
                    }else{
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='../Controller/cerrar_session.php'>Cerrar Session</a>
                        </li>";
                        

                        echo "<li class='nav-item'>
                        <a class='navbar-brand' href='#'>".$_SESSION['correo']."</a>
                        </li>";
                        
                    }
                    ?>
                </ul>
            </div>

        </div>
    </nav>

    <!-- Main -->
    <div class="main d-flex flex-column justify-content-center">


        <!--Carrucel-->
        <div id="carrucelMain" class="carousel slide mt-3">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carrucelMain" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carrucelMain" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carrucelMain" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../Img/image.png" class="d-block w-100 imgCarrucel" alt="...">
                </div>
                <!-- <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                </div> -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carrucelMain" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carrucelMain" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!--Contenido-->

        <?php

        if ($userBool) {

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
            if(curl_errno($ch)) {
                echo 'Error de cURL: ' . curl_error($ch);
                exit;
            }
            
            // Cerrar la sesión de cURL
            curl_close($ch);
            
            // Decodificar el JSON recibido
            $data = json_decode($response, true);
            
            // Verificar si los datos se han decodificado correctamente
            if ($data) {
                echo '<div class="d-flex justify-content-around flex-wrap mt-5">';
            
                // Recorrer los elementos del JSON
                foreach ($data as $item) {
                    echo '<div class="card">
                            <img src="' . $item['imagen'] . '" class="imgCard card-img-top" alt="' . $item['titulo'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $item['titulo'] . '</h5>
                                <h6 class="card-subtitle mb-2 text-muted">' . $item['categoria'] . '</h6>
                                <p class="card-text">' . $item['descripcion'] . '</p>
                                <a href="' . $item['enlace'] . '" class="btn btn-primary" target="_blank">Ver más</a>
                            </div>
                        </div>';
                }
    
                echo '</div>';
            } else {
                echo "No se pudo obtener los datos.";
            }
                        
        }   
        ?>

    </div>

</body>

</html>