<?php

require '../Model/clases.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los datos existen en el formulario
    if (isset($_POST['correo']) && isset($_POST['password'])) {
        $email = $_POST['correo'];
        $pwd = $_POST['password'];

        try {
            // Conectar a la base de datos
            $conn = new mysqli('db4free.net', 'swquioscojonas', 'sebas1379', 'swquioscoprueb');
            if ($conn->connect_error) {
                throw new Exception("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL directa (sin preparar)
            $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
            $result = $conn->query($sql);

            // Verificar si la consulta fue exitosa
            if ($result === false) {
                throw new Exception("Error en la consulta: " . $conn->error);
            }

            // Verificar si se encontró un usuario con ese correo
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verificar si la contraseña es correcta
                if ($pwd === $user['password']) {
                    

                    session_start();


                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nombre'] = $user['nombre'];
                    $_SESSION['apellido'] = $user['apellido'];
                    $_SESSION['correo'] = $user['correo'];
                    $_SESSION['password'] = $user['password'];



                    echo "Bienvenido, ".$_SESSION['nombre'].". ¡Has iniciado sesión exitosamente!";
                    echo "<p><button><a href='../Public/index.php'>Inicio</a></button></p></div>";

                } else {
                    echo "Contraseña incorrecta para $email.";
                }
            } else {
                echo "No se encontró un usuario con ese correo: $email.";
            }

            // Cerrar la conexión
            $conn->close();
        } catch (Exception $e) {
            // Capturar y mostrar cualquier error
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Faltan datos en el formulario.";
    }
}
