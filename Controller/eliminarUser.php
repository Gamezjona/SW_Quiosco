<?php 


include '../API/gateway.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {

    eliminarSubscriptor(intval($_POST['id']));
    header("Location: ../View/usuario.php");

} else {
    echo "no estan tosdos los campos";
}