<?php


include '../API/gateway.php';

if (isset($_GET['contrato']) && isset($_GET['id']) && isset($_GET['estatus']) && isset($_GET['sub'])) {

    setSubscriptor(intval($_GET['id']), intval($_GET['estatus']), $_GET['contrato']);
    header("Location: ../Controller/cerrar_session.php");

   // echo "Paga " . $_GET['contrato'] . " user id = " . $_GET['id'] . " estatus: " . $_GET['estatus'] . " sub: " . $_GET['sub'];
} else {
    echo 'algo sa';
    //header("Location: ../View/planes.php");
}
