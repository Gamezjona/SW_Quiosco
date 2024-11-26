<?php

include '../API/gateway.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {


    eliminarPatrocinador(intval($_POST['id']));

    header("Location: ../View/ptcndr.php");
} else {
    echo "no estan tosdos los campos";
}
