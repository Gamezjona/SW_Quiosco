<?php
session_start(); // Reanuda la sesión
$userBool = false;

$adminBool = false;


include '../API/gateway.php';

if (isset($_SESSION['id'])) {

    if ($_SESSION['correo'] == "root@admin.com") {
        $adminBool = true;
    }
    $userBool = true;

    $data = verTodoContenido();
} else {

    header("Location: ../Public/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
    <link rel="stylesheet" href="../Source/Css/bootstrap.min.css">
    <link rel="stylesheet" href="../Source/Css/styleContenido.css">
    <script src="../Source/JS/bootstrap.bundle.min.js"></script>

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
                        <a href="../Public/index.php" class="linkNav " aria-current="page">Inicio</a>
                    </ol>
                    <ol class="nav-item">
                        <a href="../View/planes.php" class="linkNav">Contratar un plan</a>
                    </ol>

                    <?php
                    if ($adminBool) {
                        echo '<ol class="nav-item">
    <a href="../View/usuarios.php" class="linkNav">Usuarios</a>
    </ol>';

                        echo '<ol class="nav-item">
    <a href="../View/ptcndr.php" class="linkNav">Patrocinadores</a>
    </ol>';
                    }

                    if ($userBool) {
                        echo '<ol class="nav-item">
    <a href="../View/contenido.php" class="linkNav">Contenido</a>
    </ol>';
                    }

                    ?>
                </ul>


                <div class="navbar-nav nav-btns">
                    <?php
                    if (!$userBool) {


                        /*  echo '<button class="nav-item">
    <a class="linkNav" href="../Public/index.php">Regresar</a>
    </button>'; */

                        echo '<button class="nav-item btn-naver">
    <a class="nav-link-btn " href="../View/login.html">Iniciar Sesion</a>
    </button>';

                        echo '<button class="nav-item btn-naver">
    <a class="nav-link-btn " href="../View/registro.html">Registrarme</a>
    </button>';
                    } else {

                        echo "<button class='nav-item btn-naver'>
    <a class='nav-link-btn ' href='#'>" . $_SESSION['nombre'] . "</a>
    </button>";

                        echo '<button class="nav-item btn-naver">
    <a class="nav-link-btn " href="../Controller/cerrar_session.php">Cerrar sesion</a>
    </button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-4 align-items-center flex-wrap fondo">

        <section class="container Info">

            <p class="pInfo">
                En este apartado encontraras todo sobre nuestro contenido.
            </p>

            <?php

            if ($_SESSION['sub'] == "Free") {
                echo '<p class="pInfoFoodee">
                Disfruta mejor la experiencia pagando uno de nuestros planes <a href="planes.php" class="linkIntroInfo">PLANES</a>
            </p>';
            }
            ?>


        </section>

        <section class="contenido">

            <div clases="introContenido">
                <p class="pIntroContenido">
                    Lo mas nuevo del mes
                </p>
            </div>

            <?php if ($adminBool) { ?>
                <div class="container my-5 text-light">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6 col-10"> <!-- Ajuste de ancho para hacer el formulario más pequeño -->
                            <h1 class="text-center mb-4" style="font-size: 1.5rem;">Agregar Nuevo Contenido</h1>
                            <form action="../Controller/nuevoContenido.php" method="post" enctype="multipart/form-data" class="p-3 border rounded shadow" style="font-size: 0.9rem;">
                                <div class="mb-2">
                                    <label for="titulo" class="form-label">Título:</label>
                                    <input type="text" id="titulo" name="titulo" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-2">
                                    <label for="categoria" class="form-label">Categoría:</label>
                                    <input type="text" id="categoria" name="categoria" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-2">
                                    <label for="descripcion" class="form-label">Descripción:</label>
                                    <textarea id="descripcion" name="descripcion" class="form-control form-control-sm" rows="3" required></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="imagen" class="form-label">Imagen URL:</label>
                                    <input type="text" id="imagen" name="imagen" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-2">
                                    <label for="enlace" class="form-label">Enlace:</label>
                                    <input type="text" id="enlace" name="enlace" class="form-control form-control-sm" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 btn-sm">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>



            <div class="container mt-3">

                <div class="row g-4"> <!-- Contenedor de filas y columnas -->
                    <?php
                    if (intval($_SESSION['estatus']) == 1) {
                        // Verificar si los datos se han decodificado correctamente
                        if ($data) {
                            // Recorrer los elementos del JSON
                            foreach ($data as $item) {
                                echo '<div class="col-md-4 col-sm-6 col-12">'; // Columnas para diseño responsivo
                                echo '<div class="card" style="width: 100%; margin: auto;">
                            <div class="imgCard d-flex justify-content-center">
                                <img src="' . $item['imagen'] . '" class="img-fluid imagenClass" alt="' . $item['titulo'] . '" style="max-height: 200px; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                ' . ($adminBool ? '<a href="../Controller/eliminarContenido.php?id=' . $item['id'] . '" class="btn btn-danger">Borrar</a>' : '') . '
                                <h5 class="card-title">' . $item['titulo'] . '</h5>
                                <h6 class="card-subtitle mb-1 text-muted">' . $item['categoria'] . '</h6>
                                <p class="card-text" style="max-height: 100px; overflow-y: auto;">' . $item['descripcion'] . '</p>
                                <a href="' . $item['enlace'] . '" class="btn btn-primary" target="_blank">Ver más</a>
                            </div>
                        </div>';
                                echo '</div>'; // Cerrar columna

                                if ($_SESSION['sub'] == "Free") {
                                    break;
                                }
                            }

                            if ($_SESSION['sub'] == "Free") {
                                echo '<h1 class="text-center">Si quieres ver más contenido, debes ser Premium</h1>';
                            }
                        } else {
                            echo '<h1 class="text-center">No se pudo obtener los datos.</h1>';
                        }
                    } else {
                        echo '<h1 class="text-center">Tu cuenta ha sido suspendida.</h1>';
                    }
                    ?>
                </div>
            </div>


        </section>
    </div>




</body>

</html>