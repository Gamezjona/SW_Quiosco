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
    <link rel="stylesheet" href="../Source/Css/index.css">
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



    <section class="intro">
        <div class="introInfo">
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

        <?php if ($adminBool) { ?>

            <h1>Agregar Nuevo Contenido</h1>
            <form action="../Controller/nuevoContenido.php" method="post" enctype="multipart/form-data">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required><br><br>

                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" required><br><br>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea><br><br>

                <label for="imagen">Imagen Url:</label>
                <input type="url" id="imagen" name="imagen" required><br><br>

                <label for="enlace">Enlace:</label>
                <input type="url" id="enlace" name="enlace" required><br><br>

                <button type="submit">Enviar</button>
            </form>

        <?php } ?>

        <div class="contenidoFull">

            <?php
            if (intval($_SESSION['estatus']) == 1) {


                
                // Verificar si los datos se han decodificado correctamente
                if ($data) {
                    echo '<div class="d-flex justify-content-around flex-wrap mt-5">';

                    // Recorrer los elementos del JSON
                    //foreach ($data as $item)
                    foreach ($data as $item) {
                        if($adminBool){$eliminar = '<a href="../Controller/eliminarContenido.php?id='.$item['id'].'" class="btn btn-danger">Borrar</a>';}else{$eliminar = "";};
                        echo '<div class="card">
                                <img src="' . $item['imagen'] . '" class="card-img-top" style="width: 18rem;" alt="' . $item['titulo'] . '">
                                <div class="card-body">
                                '.$eliminar.'
                                <h5 class="card-title">' . $item['titulo'] . '</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">' . $item['categoria'] . '</h6>
                                    <p class="card-text">' . $item['descripcion'] . '</p>
                                    <a href="' . $item['enlace'] . '" class="btn btn-primary" target="_blank">Ver más</a>
                                </div>
                            </div>';

                        if ($_SESSION['sub'] == "Free") {
                            break;
                        }
                    }

                    echo '</div>';
                    if ($_SESSION['sub'] == "Free") {
                        echo "<h1>Si Quieres ver mas contenido debes ser Premium</h1>";
                    }
                } else {
                    echo "No se pudo obtener los datos.";
                }
            } else {
                echo "<h1>Tu Cuenta a sido suspendida</h1>";
            }


            ?>

        </div>

    </section>


</body>

</html>