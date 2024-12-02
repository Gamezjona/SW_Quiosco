<?php

include '../API/gateway.php';

session_start(); // Reanuda la sesión

$userBool = false;
$adminBool = false;

if (isset($_SESSION['id'])) {

    if ($_SESSION['correo'] == "root@admin.com") {
        $adminBool = true;
    } else {
        header("Location: ../index.php");
    }
    $userBool = true;


    $data = verTodosPatrocinador();
} else {

    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrocinadores</title>
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
                        <a href="../index.php" class="linkNav " aria-current="page">Inicio</a>
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
    <a class="linkNav" href="../index.php">Regresar</a>
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

    <div class="py-5 fondo">
        <h1 class="text-center text-white my-4">Lista de Patrocinadores</h1>

        <div class="table-responsive container">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Giro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $patrocinador): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($patrocinador['id']); ?></td>
                                <td><?php echo htmlspecialchars($patrocinador['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($patrocinador['giro']); ?></td>
                                <td>
                                    <form action="../Controller/eliminarPtcndr.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($patrocinador['id']); ?>">
                                        <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay patrocinadores disponibles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulario para agregar patrocinador -->
        <div class="form-container mt-5">
            <h2 class="text-center text-white mb-3">Agregar Patrocinador</h2>
            <form action="../Controller/nuevoPtcndr.php" method="POST">
                <div class="mb-3">
                    <input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="giro" placeholder="Giro" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Agregar</button>
            </form>
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