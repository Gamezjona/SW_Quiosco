<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes</title>
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
                <?php
                if (!$userBool) {


                    echo '<button class="btnNavLink">
            <a class="linkNav" href="../Public/index.php">Regresar</a>
            </button>';

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

</body>

</html>