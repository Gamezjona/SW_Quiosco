<?php

session_start(); // Reanuda la sesión
$userBool = false;

$adminBool = false;


if (isset($_SESSION['id'])) {

    if($_SESSION['correo'] == "root@admin.com"){
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
    }else{
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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
            text-align: left;
        }

        button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
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

    <h1>Lista de Datos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Subcripcion</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['sub']; ?></td>
                        <td>
                            <?php if ($row['estatus'] == 1) {
                                echo "<span style='color: green;'>Activo</span>";
                            } else {
                                echo "<span style='color: red;'>Suspendido</span>";
                            } ?>
                        </td>
                        <td>
                            <form action="../Controller/cambiarEstatusUser.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="estatus" value="<?php echo $row['estatus']; ?>">
                                <input type="hidden" name="sub" value="<?php echo $row['sub']; ?>">
                                <button type="submit">Cambiar Estatus</button>
                            </form>

                            <form action="../Controller/cambiarPlanUser.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="estatus" value="<?php echo $row['estatus']; ?>">
                                <input type="hidden" name="sub" value="<?php echo $row['sub']; ?>">
                                <button type="submit">Cambiar Plan</button>
                            </form>

                            <form action="eliminarUser.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Eliminar</button> 
                            </form>

                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay datos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>