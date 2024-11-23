<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que los campos del formulario no estén vacíos
    if (isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['password'], $_POST['confirmar_password'])) {
        
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $correo = trim($_POST['correo']);
        $password = $_POST['password'];
        $confirmarPassword = $_POST['confirmar_password'];
        $terminos = isset($_POST['terminos']) ? $_POST['terminos'] : null;


        // Mostrar los datos insertados en una carta HTML
        echo "<div style='border: 1px solid #ddd; padding: 20px; width: 300px; margin: 0 auto; font-family: Arial, sans-serif; background-color: #f4f4f4;'>
        <h2 style='color: #333;'>Registro Exitoso</h2>
        <p><strong>Nombre:</strong> $nombre</p>
        <p><strong>Apellido:</strong> $apellido</p>
        <p><strong>Correo Electrónico:</strong> $correo</p>
        <p><strong>Contraseña:</strong> " . (empty($password) ? 'No visible' : '*****') . "</p>
        <p><em>Gracias por registrarte con nosotros.</em></p>
        <p><button><a href='../Public/index.php'>Iniciar Sesion</a></button></p></div>";
/* 
        // Validar que los campos no estén vacíos
        if (empty($nombre) || empty($apellido) || empty($correo) || empty($password) || empty($confirmarPassword)) {
            echo "Todos los campos son obligatorios.";
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            // Validar el correo electrónico
            echo "El correo electrónico no es válido.";
        } elseif ($password !== $confirmarPassword) {
            // Validar que las contraseñas coincidan
            echo "Las contraseñas no coinciden.";
        } elseif (!$terminos) {
            // Validar que el usuario haya aceptado los términos
            echo "Debe aceptar los términos y condiciones.";
        } else {
            try {
                // Conexión a la base de datos
                $conn = new mysqli('db4free.net', 'swquioscojonas', 'sebas1379', 'swquioscoprueb');
                if ($conn->connect_error) {
                    throw new Exception("Conexión fallida: " . $conn->connect_error);
                }

                // Preparar la consulta SQL
                $sql = "INSERT INTO usuarios (nombre, apellido, correo, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Error en la preparación de la consulta: " . $conn->error);
                }

                // Vincular parámetros y ejecutar la consulta
                $stmt->bind_param("ssss", $nombre, $apellido, $correo, $password);
                if (!$stmt->execute()) {
                    throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
                }

                // Cerrar la declaración y la conexión
                $stmt->close();
                $conn->close();

                // Mostrar los datos insertados en una carta HTML
                echo "<div style='border: 1px solid #ddd; padding: 20px; width: 300px; margin: 0 auto; font-family: Arial, sans-serif; background-color: #f4f4f4;'>
                        <h2 style='color: #333;'>Registro Exitoso</h2>
                        <p><strong>Nombre:</strong> $nombre</p>
                        <p><strong>Apellido:</strong> $apellido</p>
                        <p><strong>Correo Electrónico:</strong> $correo</p>
                        <p><strong>Contraseña:</strong> " . (empty($password) ? 'No visible' : '*****') . "</p>
                        <p><em>Gracias por registrarte con nosotros.</em></p>
                        <p><button><a href='../Public/index.php'>Iniciar Sesion</a></button></p>

                    </div>";
            } catch (Exception $e) {
                // Capturar cualquier excepción y mostrar el error
                echo "<p style='color: red; font-family: Arial, sans-serif;'>Error: " . $e->getMessage() . "</p>";
            }
        } */
    } else {
        echo "Por favor complete todos los campos.";
    }
}
?>