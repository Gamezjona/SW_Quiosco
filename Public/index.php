<?php

session_start(); // Reanuda la sesión


$userBool = false;

$adminBool = false;


if (isset($_SESSION['id'])) {

    if($_SESSION['correo'] == "root@admin.com"){
        $adminBool = true;
    }
    
    $userBool = true;

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
    <script src="../Source/JS/sweetalert2.all.min.js"></script>
    <script src="../Source/JS/script.js"></script>
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
                if ($adminBool){

                    echo '<ol class="linkNavItem">
                    <a href="" class="linkNav">Subcripciones</a>
                    </ol>';


                    echo '<ol class="linkNavItem">
                    <a href="../View/usuarios.php" class="linkNav">Usuarios</a>
                    </ol>';

                }

                if($userBool){
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
                <?php
                if (!$userBool) {


                   /*  echo '<button class="btnNavLink">
                    <a class="linkNav" href="../Public/index.php">Regresar</a>
                    </button>'; */

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

    </div>

</body>

</html>