<?php

include '../API/gateway.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['estatus']) && isset($_POST['sub'])) {

    $f = "Free";
    $p = "Premium";
    
    if ($_POST['sub'] == "Free") {
        setSubscriptor($_POST['id'], intval($_POST['estatus']),  $p);

    } else {
        setSubscriptor($_POST['id'], intval($_POST['estatus']), $f);

    }
} else {
    echo "no estan tosdos los campos";
}
