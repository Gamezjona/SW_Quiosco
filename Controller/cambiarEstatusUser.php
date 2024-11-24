<?php

include '../API/gateway.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['estatus']) && isset($_POST['sub'])) {


    if ($_POST['estatus'] == 0) {
        setSubscriptor($_POST['id'], 1 ,$_POST['sub']);
    } else {
        setSubscriptor($_POST['id'], 0, $_POST['sub']);
    }
} else {
    echo "no estan tosdos los campos";
}
