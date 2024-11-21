<?php
// Datos de la conexión a la base de datos
$host = "localhost";
$usuario_db = "root"; // Usuario predeterminado de MySQL en localhost
$clave_db = ""; // Contraseña vacía para la mayoría de instalaciones locales
$nombre_db = "costalito_de_sal";

// Crear la conexión
$conn = new mysqli($host, $usuario_db, $clave_db, $nombre_db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de la tabla `contenido`
$sql = "SELECT * FROM contenido";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiosco Digital</title>
    <link rel="stylesheet" href="Css\styleIndex.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="#" style="font-size: 1.5rem; font-weight: bold;">Quiosco Digital</a>
            <div>
                <a href="#home">Inicio</a>
                <a href="#search">Buscar</a>
                <a href="perfil.php">Perfil</a>
                <a href="View\login.html" class="button">Login</a>
            </div>
        </div>
    </nav>

    <main class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <section id="home">
            <h1>Bienvenido al Quiosco Digital</h1>
            <div class="grid">
                <?php
                if ($resultado->num_rows > 0) {
                    // Generar tarjetas para cada registro en la tabla
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<img src="' . htmlspecialchars($fila['imagen']) . '" alt="' . htmlspecialchars($fila['titulo']) . '" style="width: 100%; height: 200px; object-fit: cover;">';
                        echo '<div class="card-content">';
                        echo '<h2>' . htmlspecialchars($fila['titulo']) . '</h2>';
                        echo '<p>' . htmlspecialchars($fila['descripcion']) . '</p>';
                        echo '<a href="' . htmlspecialchars($fila['enlace']) . '" class="button">Leer ahora</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No hay contenido disponible.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Quiosco Digital. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
