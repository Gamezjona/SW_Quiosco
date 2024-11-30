<?php 


include '../API/gateway.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Datos del formulario
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $enlace = $_POST['enlace'];
    $imgUrl = $_POST['imagen'];

    nuevoContenido($titulo,$categoria,$descripcion,$enlace,$imgUrl);
    header("Location: ../View/contenido.php");

}