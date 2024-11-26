<?php


include '../API/webkoks.php';
include '../API/gateway.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que los campos del formulario no estén vacíos
    if (isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['password'], $_POST['confirmar_password'])) {

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $correo = trim($_POST['correo']);
        $password = $_POST['password'];
        $confirmarPassword = $_POST['confirmar_password'];
        $terminos = isset($_POST['terminos']) ? $_POST['terminos'] : null;

        if (empty($nombre) || empty($apellido) || empty($correo) || empty($password) || empty($confirmarPassword)) {
            header("Location: ../View/registro.php?funcion=errorParametros&txtError=Todos los campos son obligatorios.");
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../View/registro.php?funcion=errorParametros&txtError=El correo electrónico no es válido.");
        } elseif ($password !== $confirmarPassword) {
            header("Location: ../View/registro.php?funcion=errorParametros&txtError=Las contraseñas no coinciden.");
        } elseif (!$terminos) {
            header("Location: ../View/registro.php?funcion=errorParametros&txtError=Debe aceptar los términos y condiciones.");
        } else {
            try {

                $conn = new mysqli('db4free.net', 'swquioscojonas', 'sebas1379', 'swquioscoprueb');
                if ($conn->connect_error) {
                    throw new Exception("Conexión fallida: " . $conn->connect_error);
                }

                //CREAR NUEVA SUBSCRIPCION DESDE EL API SUBSCRIPCION
                $sql = "SELECT id FROM usuarios WHERE correo = '$correo' AND nombre = '$nombre'";
                $result = $conn->query($sql);

                if ($result === false) {
                    throw new Exception("Error en la consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    header("Location: ../View/registro.php?funcion=errorParametros&txtError=El usuario ya existe");
                    exit();
                }



                $sql = "INSERT INTO usuarios (nombre, apellido, correo, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Error en la preparación de la consulta: " . $conn->error);
                }

                $stmt->bind_param("ssss", $nombre, $apellido, $correo, $password);

                if (!$stmt->execute()) {
                    throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
                }

                //CREAR NUEVA SUBSCRIPCION DESDE EL API SUBSCRIPCION
                $sql = "SELECT id FROM usuarios WHERE correo = '$correo' AND nombre = '$nombre'";
                $result = $conn->query($sql);

                if ($result === false) {
                    throw new Exception("Error en la consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    $id = $user['id'];

                    nuevoSubscriptor($id);
                    //ENVIAR A MI WEBHOOKK
                    nuevoUsuario($correo,$id);
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
                
                header("Location: ../View/registro.php?funcion=errorParametros&txtError=".$e->getMessage());
            }
        }
    } else {
        header("Location: ../View/registro.php?funcion=errorParametros&txtError=Por favor complete todos los campos.");
    }
}
