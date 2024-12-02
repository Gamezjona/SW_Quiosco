<?php

session_start(); // Reanuda la sesión
$userBool = false;

$adminBool = false;


if (isset($_SESSION['id'])) {

    if ($_SESSION['correo'] == "root@admin.com") {
        $adminBool = true;
        $userBool = true;

        $conn = new mysqli('db4free.net', 'swquioscojonas', 'sebas1379', 'swquioscoprueb');

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }

        // Consulta para obtener los datos
        $sql = "SELECT subscripciones.id, usuarios.nombre, usuarios.correo, subscripciones.sub, subscripciones.estatus
        FROM subscripciones
        INNER JOIN usuarios ON subscripciones.id = usuarios.id;"; // Cambia "mi_tabla" a tu tabla
        $result = $conn->query($sql);
    } else {
        header("Location: ../Public/index.php");
    }
} else {

    header("Location: ../Public/index.php");
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid con Botones</title>
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



    <div class="fondo py-5">
        <h1 class="text-center text-white mb-4">Lista de Usuarios</h1>
        <div class="table-responsive container">
            <table class="table table-striped table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Subcripción</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php if ($row['correo'] == "root@admin.com") {
                                continue;
                            }; ?>
                            <tr class="text-center">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                                <td><?php echo $row['sub']; ?></td>
                                <td>
                                    <?php if ($row['estatus'] == 1): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Suspendido</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="../Controller/cambiarEstatusUser.php" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="estatus" value="<?php echo $row['estatus']; ?>">
                                        <input type="hidden" name="sub" value="<?php echo $row['sub']; ?>">
                                        <button type="submit" class="btn btn-info btn-sm">Cambiar Estatus</button>
                                    </form>

                                    <form action="../Controller/cambiarPlanUser.php" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="estatus" value="<?php echo $row['estatus']; ?>">
                                        <input type="hidden" name="sub" value="<?php echo $row['sub']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Cambiar Plan</button>
                                    </form>

                                    <form action="../Controller/eliminarUser.php" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay datos disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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

<?php
// Cerrar la conexión
$conn->close();
?>