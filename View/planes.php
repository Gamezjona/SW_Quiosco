<?php
session_start(); // Reanuda la sesión
$userBool = false;
$adminBool = false;
$alertabool = false;

if (isset($_SESSION['id'])) {

    include '../Model/clases.php';

    if ($_SESSION['correo'] == "root@admin.com") {
        $adminBool = true;
    }

    $userBool = true;

    if (isset($_GET['funcion'])) {
        $alerta = new Alerta($_GET['funcion']);
        $alertabool = true;
        $_GET = $_GET['funcion'];
    }
} else {

    //header("Location: ../Public/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes</title>
    <link rel="stylesheet" href="../Source/Css/bootstrap.min.css">
    <script src="../Source/JS/sweetalert2.all.min.js"></script>
    <script src="../Source/JS/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../Source/Css/StylePlan.css">


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
    <a class="nav-link-btn " href="../View/registro.php">Registrarme</a>
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

    <section class="planes py-5 fondoPlan">
        <?php if (!isset($_SESSION['id'])) { ?>
            <div class="alert alert-warning text-center" role="alert">
                Necesitas iniciar sesión para contratar un plan.
            </div>
        <?php } else { ?>
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <!-- Plan Premium -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://th.bing.com/th/id/OIP.I-L3AjNCIwmFum7MMkOcPAHaHa?rs=1&pid=ImgDetMain"
                                class="card-img-top img-fluid"
                                alt="Plan Premium"
                                style="object-fit: cover; height: 200px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Premium</h5>
                                <p class="card-text">Suscríbete con este plan y podrás ver todo nuestro contenido disponible.</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contratarPlanModal"
                                    <?php if (isset($_SESSION['sub']) && $_SESSION['correo'] !== "root@admin.com" && $_SESSION['sub'] === "Premium") {
                                        echo 'disabled aria-disabled="true"';
                                    } ?>>
                                    Contratar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Free -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://th.bing.com/th/id/OIP.ta3k2VChGjj3vVIMNYeV0wHaEK?rs=1&pid=ImgDetMain"
                                class="card-img-top img-fluid"
                                alt="Plan Free"
                                style="object-fit: cover; height: 200px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Free</h5>
                                <p class="card-text">Con este plan solo podrás visualizar un elemento del contenido.</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contratarPlanFreeModal"
                                    <?php if (isset($_SESSION['sub']) && $_SESSION['correo'] !== "root@admin.com" && $_SESSION['sub'] === "Free") {
                                        echo 'disabled aria-disabled="true"';
                                    } ?>>
                                    Contratar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Plan Premium -->
            <div class="modal fade" id="contratarPlanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Contratar Plan Premium</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            ¿Estás seguro de contratar nuestro plan Premium?
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="../Controller/contratarPlan.php?contrato=Premium&id=<?php echo $_SESSION['id']; ?>&estatus=<?php echo intval($_SESSION['estatus']); ?>&sub=<?php echo $_SESSION['sub']; ?>"
                                class="btn btn-success">
                                Contratar Plan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Plan Free -->
            <div class="modal fade" id="contratarPlanFreeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Contratar Plan Free</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            ¿Estás seguro de contratar nuestro plan Free?
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="../Controller/contratarPlan.php?contrato=Free&id=<?php echo $_SESSION['id']; ?>&estatus=<?php echo intval($_SESSION['estatus']); ?>&sub=<?php echo $_SESSION['sub']; ?>"
                                class="btn btn-success">
                                Contratar Plan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>


    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>© 2024 Tu Empresa. Todos los derechos reservados.</p>
            <p><a href="#" class="text-white">Política de privacidad</a> | <a href="#" class="text-white">Términos y condiciones</a></p>
        </div>
    </footer>
</body>

</html>