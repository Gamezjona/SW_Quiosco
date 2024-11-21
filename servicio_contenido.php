<?php
header("Content-Type: application/json");

// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
/* if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'eduardo-cofe@hotmail.com') {
    http_response_code(401);
    echo json_encode(["error" => "Acceso no autorizado. Debes estar logueado."]);
    exit;
} */

// Conexión a la base de datos
$dsn = 'mysql:host=localhost;dbname=costalito_de_sal;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
    exit;
}

// Método HTTP y datos recibidos
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'POST': // Crear contenido
        if (isset($input['titulo'], $input['descripcion'], $input['imagen'], $input['enlace'], $input['categoria'])) {
            // Validar si la categoría tiene un valor correcto
            if (empty($input['categoria']) || !is_string($input['categoria'])) {
                http_response_code(400);
                echo json_encode(["error" => "Categoria inválida"]);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO contenido (titulo, categoria, descripcion, imagen, enlace) VALUES (:titulo, :categoria, :descripcion, :imagen, :enlace)");
            $stmt->execute([
                ':titulo' => $input['titulo'],
                ':categoria' => $input['categoria'],
                ':descripcion' => $input['descripcion'],
                ':imagen' => $input['imagen'],
                ':enlace' => $input['enlace']
            ]);
            echo json_encode(["success" => true, "id" => $pdo->lastInsertId()]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos para crear contenido"]);
        }
        break;

    case 'PUT': // Actualizar contenido
        if (isset($input['id']) && is_numeric($input['id'])) {
            $fields = [];
            $params = [':id' => $input['id']];
            
            if (!empty($input['titulo'])) {
                $fields[] = "titulo = :titulo";
                $params[':titulo'] = $input['titulo'];
            }
            if (!empty($input['categoria'])) {
                $fields[] = "categoria = :categoria";
                $params[':categoria'] = $input['categoria'];
            }
            if (!empty($input['descripcion'])) {
                $fields[] = "descripcion = :descripcion";
                $params[':descripcion'] = $input['descripcion'];
            }
            if (!empty($input['imagen'])) {
                $fields[] = "imagen = :imagen";
                $params[':imagen'] = $input['imagen'];
            }
            if (!empty($input['enlace'])) {
                $fields[] = "enlace = :enlace";
                $params[':enlace'] = $input['enlace'];
            }

            if ($fields) {
                $query = "UPDATE contenido SET " . implode(", ", $fields) . " WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                echo json_encode(["success" => true]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Nada que actualizar"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "ID inválido o no proporcionado"]);
        }
        break;

    case 'DELETE': // Eliminar contenido
        if (isset($input['id']) && is_numeric($input['id'])) {
            $stmt = $pdo->prepare("DELETE FROM contenido WHERE id = :id");
            $stmt->execute([':id' => $input['id']]);
            echo json_encode(["success" => true]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "ID inválido o no proporcionado"]);
        }
        break;

    case 'GET': // Listar contenido
        $stmt = $pdo->query("SELECT * FROM contenido");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}

// Cerrar conexión
$pdo = null;
?>
