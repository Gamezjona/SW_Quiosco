<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Contenido</title>
    <link rel="stylesheet" href="..\Css\styleAdminContenido.css">
</head>
<body>
    <h1>Administrador de Contenido</h1>

    <!-- Formulario para crear contenido -->
    <form id="form-crear">
        <h3>Crear Nuevo Contenido</h3>
        <label for="crear-titulo">Título:</label>
        <input type="text" id="crear-titulo" name="titulo" required>

        <label for="crear-categoria">Categoria:</label>
        <input type="text" id="crear-categoria" name="categoria" required>
        
        <label for="crear-descripcion">Descripción:</label>
        <textarea id="crear-descripcion" name="descripcion" required></textarea>
        
        <label for="crear-imagen">URL de la Imagen:</label>
        <input type="text" id="crear-imagen" name="imagen" required>
        
        <label for="crear-enlace">Enlace:</label>
        <input type="text" id="crear-enlace" name="enlace" required>
        
        <button type="button" onclick="crearContenido()">Crear</button>
        <div class="result" id="result-crear"></div>
    </form>

    <!-- Formulario para actualizar contenido -->
    <form id="form-actualizar">
        <h3>Actualizar Contenido</h3>
        <label for="actualizar-id">ID del Contenido:</label>
        <input type="number" id="actualizar-id" name="id" required>
        
        <label for="actualizar-titulo">Título (opcional):</label>
        <input type="text" id="actualizar-titulo" name="titulo">

        <label for="actualizar-categoria">Categoria (opcional):</label>
        <input type="text" id="actualizar-categoria" name="categoria">
        
        <label for="actualizar-descripcion">Descripción (opcional):</label>
        <textarea id="actualizar-descripcion" name="descripcion"></textarea>
        
        <label for="actualizar-imagen">URL de la Imagen (opcional):</label>
        <input type="text" id="actualizar-imagen" name="imagen">
        
        <label for="actualizar-enlace">Enlace (opcional):</label>
        <input type="text" id="actualizar-enlace" name="enlace">
        
        <button type="button" onclick="actualizarContenido()">Actualizar</button>
        <div class="result" id="result-actualizar"></div>
    </form>

    <!-- Formulario para eliminar contenido -->
    <form id="form-eliminar">
        <h3>Eliminar Contenido</h3>
        <label for="eliminar-id">ID del Contenido:</label>
        <input type="number" id="eliminar-id" name="id" required>
        
        <button type="button" onclick="eliminarContenido()">Eliminar</button>
        <div class="result" id="result-eliminar"></div>
    </form>

    <script>
        const API_URL = "servicio_contenido.php"; // URL del microservicio

        // Función para crear contenido
        async function crearContenido() {
            const data = {
                titulo: document.getElementById("crear-titulo").value,
                categoria: document.getElementById("crear-categoria").value,
                descripcion: document.getElementById("crear-descripcion").value,
                imagen: document.getElementById("crear-imagen").value,
                enlace: document.getElementById("crear-enlace").value
            };

            const result = await fetch(API_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Basic " + btoa("admin:admin123") // Cambia por tus credenciales
                },
                body: JSON.stringify(data)
            }).then(res => res.json());

            document.getElementById("result-crear").innerText = JSON.stringify(result, null, 2);
        }

        // Función para actualizar contenido
        async function actualizarContenido() {
            const data = {
                id: document.getElementById("actualizar-id").value,
                titulo: document.getElementById("actualizar-titulo").value,
                categoria: document.getElementById("actualizar-categoria").value,
                descripcion: document.getElementById("actualizar-descripcion").value,
                imagen: document.getElementById("actualizar-imagen").value,
                enlace: document.getElementById("actualizar-enlace").value
            };

            const result = await fetch(API_URL, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Basic " + btoa("admin:admin123") // Cambia por tus credenciales
                },
                body: JSON.stringify(data)
            }).then(res => res.json());

            document.getElementById("result-actualizar").innerText = JSON.stringify(result, null, 2);
        }

        // Función para eliminar contenido
        async function eliminarContenido() {
            const data = {
                id: document.getElementById("eliminar-id").value
            };

            const result = await fetch(API_URL, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Basic " + btoa("admin:admin123") // Cambia por tus credenciales
                },
                body: JSON.stringify(data)
            }).then(res => res.json());

            document.getElementById("result-eliminar").innerText = JSON.stringify(result, null, 2);
        }
    </script>
</body>
</html>
