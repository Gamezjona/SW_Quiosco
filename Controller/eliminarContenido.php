<?php 

include '../API/gateway.php';

if(isset($_GET['id'])){

    eliminarContenido(intval($_GET['id']));

    header("Location: ../View/contenido.php");

}