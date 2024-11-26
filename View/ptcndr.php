<?php

include '../API/gateway.php';

session_start(); // Reanuda la sesión

$userBool = false;
$adminBool = false;

if (isset($_SESSION['id'])) {

    if ($_SESSION['correo'] == "root@admin.com") {
        $adminBool = true;
    } else {
        header("Location: ../Public/index.php");
    }
    $userBool = true;


    $data = verTodosPatrocinador();
} else {

    header("Location: ../Public/index.php");
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


    <style>
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .form-container {
            width: 50%;
            margin: 20px auto;
            text-align: center;
        }

        .form-container input {
            margin: 5px;
            padding: 8px;
        }

        .form-container button {
            padding: 8px 12px;
            cursor: pointer;
        }
    </style>
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





    <h1 style="text-align: center;">Lista de Patrocinadores</h1>
    <table>
        <thead>
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
                            <form action="../Controller/eliminarPtcndr.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($patrocinador['id']); ?>">
                                <button type="submit" name="action" value="delete" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No hay patrocinadores disponibles</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="form-container">
        <h2>Agregar Patrocinador</h2>
        <!-- <form action="https://ws-api-gateway-latest.onrender.com/SWPatrocinador/Nuevo" method="POST"> -->
        <form action="../Controller/nuevoPtcndr.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="giro" placeholder="Giro" required>
            <button type="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>

</html>