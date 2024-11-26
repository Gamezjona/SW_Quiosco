<?php

include '../API/gateway.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre']) && isset($_POST['giro']) ) {


    nuevoPatrocinador($_POST['nombre'],$_POST['giro']);

    header("Location: ../View/ptcndr.php");
} else {
    echo "no estan tosdos los campos";
}
