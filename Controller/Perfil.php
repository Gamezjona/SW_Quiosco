<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Conexión a la base de datos
$dsn = 'mysql:host=localhost;dbname=costalito_de_sal;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Recuperar el correo del usuario desde la sesión
$email = $_SESSION['usuario'];

// Consultar los datos del usuario en la base de datos
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
  <link rel="stylesheet" href="styleperfil.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo"><h1>Kiosco Digital</h1></div>
      <div class="links">
        <ul>
          <li><a class="active" href="#">Perfil</a></li>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="#">Buscar</a></li>
        </ul>
      </div>

      <div class="login-sec">
        <button><a href="logout.php">Logout</a></button> <!-- Enlace para cerrar sesión -->
      </div>
    </nav>

    <section class="user-profile">
      <div class="profile-image">
          <img src="https://images.pexels.com/photos/3763188/pexels-photo-3763188.jpeg" alt="Foto de perfil">
      </div>
      <div class="profile-info">
          <h2>Nombre de Usuario: <?php echo $usuario['nombre']; ?></h2> <!-- Nombre del usuario -->
          <p>Apellido: <?php echo $usuario['apellido']; ?></p> <!-- Descripción del usuario -->
          <p>Correo electrónico: <?php echo $usuario['correo']; ?></p> <!-- Correo del usuario -->
          <p>Suscripcion: <?php echo $suscripciones['suscripcion']; ?></p> <!-- Descripción del usuario -->
      </div>
    </section>
  </header>
</body>
</html>
