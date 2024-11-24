<?php


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
    <link rel="stylesheet" href="../Source/Css/bootstrap.min.css">
</head>

<body>

    <header>

        <div class="logo">
            <img src="" alt="" class="logoImg">
            <p class="logoNombre"></p>
        </div>
        <nav class="navLinks">

            <ul class="links">
                <ol class="linkNavItem">
                    <a href="" class="linkNav">Inicio</a>
                </ol>
                <ol class="linkNavItem">
                    <a href="../View/planes.php" class="linkNav">Contratar un plan</a>
                </ol>

                <?php
                if ($adminBool) {

                    echo '<ol class="linkNavItem">
            <a href="" class="linkNav">Subcripciones</a>
            </ol>';


                    echo '<ol class="linkNavItem">
            <a href="../View/usuarios.php" class="linkNav">Usuarios</a>
            </ol>';
                }

                if ($userBool) {
                    echo '<ol class="linkNavItem">
            <a href="../View/contenido.php" class="linkNav">Contenido</a>
            </ol>';

                    echo '<ol class="linkNavItem">
            <a href="" class="linkNav">Patrocinadores</a>
            </ol>';
                }

                ?>
            </ul>


            <div class="btnsNavLinks">


                <button class="btnNavLink" onclick="window.location.href='../Public/index.php'">
                    Regresar
                </button>

                <?php
                if (!$userBool) {

                    echo '<button class="btnNavLink">
            <a class="nav-link" href="../View/login.html">Iniciar Sesion</a>
            </button>';

                    echo '<button class="btnNavLink">
            <a class="nav-link" href="../View/registro.html">Registrarme</a>
            </button>';
                } else {

                    echo "<button class='linkNavItem'>
            <a class='navbar-brand' href='#'>" . $_SESSION['nombre'] . "</a>
            </button>";

                    echo '<button class="btnNavLink">
            <a class="nav-link" href="../Controller/cerrar_session.php">Cerrar sesion</a>
            </button>';
                }
                ?>
            </div>
        </nav>
    </header>

    <section class="intro">
        <div class="introInfo">
            <p class="pInfo">
                En este apartado encontraras todo sobre nuestro contenido.
            </p>
            <p class="pInfoFoodee">
                Disfruta mejor la experiencia pagando uno de nuestros planes <a href="" class="linkIntroInfo">PLANES</a>
            </p>
        </div>
        <div class="introCarrucel">
            Aqui ira un carrucel
        </div>
    </section>

    <section class="contenido">

        <div clases="introContenido">
            <p class="pIntroContenido">
                Es lo mejor de lo mejor
            </p>
        </div>

        <div class="contenidoFull">


            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <?php
            if (/*$userBool*/false) {

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

                // Verificar si los datos se han decodificado correctamente
                if ($data) {
                    echo '<div class="d-flex justify-content-around flex-wrap mt-5">';

                    // Recorrer los elementos del JSON
                    foreach ($data as $item) {
                        echo '<div class="card">
                    <img src="' . $item['imagen'] . '" class="card-img-top" alt="' . $item['titulo'] . '">
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

    </section>


</body>

</html>