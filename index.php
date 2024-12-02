<?php

session_start(); // Reanuda la sesión


$userBool = false;

$adminBool = false;


if (isset($_SESSION['id'])) {

    if ($_SESSION['correo'] == "root@admin.com") {
        $adminBool = true;
    }

    $userBool = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="Source/Css/bootstrap.min.css">
    <link rel="stylesheet" href="Source/Css/index.css">

    <script src="Source/JS/bootstrap.bundle.min.js"></script>
    <script src="Source/JS/sweetalert2.all.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">QUISOCO DIGITAL</a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse  justify-content-between" id="navbarNav">

                <ul class="navbar-nav">

                    <ol class="nav-item">
                        <a href="" class="linkNav " aria-current="page">Inicio</a>
                    </ol>
                    <ol class="nav-item">
                        <a href="View/planes.php" class="linkNav">Contratar un plan</a>
                    </ol>

                    <?php
                    if ($adminBool) {

                        echo '<ol class="nav-item">
    <a href="View/usuarios.php" class="linkNav">Usuarios</a>
    </ol>';

                        echo '<ol class="nav-item">
    <a href="View/ptcndr.php" class="linkNav">Patrocinadores</a>
    </ol>';
                    }

                    if ($userBool) {
                        echo '<ol class="nav-item">
    <a href="View/contenido.php" class="linkNav">Contenido</a>
    </ol>';
                    }

                    ?>
                </ul>


                <div class="navbar-nav nav-btns">
                    <?php
                    if (!$userBool) {


                        /*  echo '<button class="nav-item">
    <a class="linkNav" href="index.php">Regresar</a>
    </button>'; */

                        echo '<button class="nav-item btn-naver">
    <a class="nav-link-btn " href="View/login.html">Iniciar Sesion</a>
    </button>';

                        echo '<button class="nav-item btn-naver">
    <a class="nav-link-btn " href="View/registro.php">Registrarme</a>
    </button>';
                    } else {

                        echo "<button class='nav-item btn-naver'>
    <a class='nav-link-btn ' href='#'>" . $_SESSION['nombre'] . "</a>
    </button>";

                        echo '<button class="nav-item btn-naver">
    <a class="nav-link-btn " href="Controller/cerrar_session.php">Cerrar sesion</a>
    </button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>



    <!-- Main -->
    <div class="fondo py-5">

        <div class="planActual">
            <h1><?php if (isset($_SESSION['sub'])) {
                    echo "<p>Tu plan actual es: " . $_SESSION['sub'] . "</p>";
                } else {
                    echo "<p>Inicia Session</p>";
                } ?></h1>
        </div>

        <!-- Carrusel -->
        <div class="carrucel mt-lg-3">
            <div id="carrucelMain" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Img/c1.jpg" class="d-block imgCarrucel" alt="Primera imagen">
                    </div>
                    <div class="carousel-item">
                        <img src="Img/c2.jpg" class="d-block imgCarrucel" alt="Segunda imagen">
                    </div>
                    <div class="carousel-item">
                        <img src="Img/c3.jpg" class="d-block imgCarrucel" alt="Tercera imagen">
                    </div>
                    <div class="carousel-item">
                        <img src="Img/c4.jpg" class="d-block imgCarrucel" alt="Cuarta imagen">
                    </div>
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
        </div>
    </div>
    
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>© 2024 Tu Empresa. Todos los derechos reservados.</p>
            <p><a href="#" class="text-white">Política de privacidad</a> | <a href="#" class="text-white">Términos y condiciones</a></p>
        </div>
    </footer>
</body>

</html>