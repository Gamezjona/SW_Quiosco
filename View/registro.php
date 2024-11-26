<?php


include '../Model/clases.php';

$alertaBool = false;

if(isset($_GET['funcion']) && isset($_GET['txtError'])){
    $fn = $_GET['funcion'];
    $error = $_GET['txtError'];
    $alerta = new Alerta($fn);

    $alertaBool = true;
    
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../Source/Css/style_registro.css">
    <script src="../Source/JS/sweetalert2.all.min.js"></script>
</head>

<body class="bodyRegistro">
    <?php 
    if($alertaBool){
        $alerta->mostrarAlerta($error);
    }
    
    ?>

    <header>
        <div class="logo">
            <img src="" alt="" class="logoImg">
            <p class="logoNombre"></p>
        </div>


        <nav class="navLinks">
            <button class="btnNavLink" onclick="window.location.href='../Public/index.php'">
                Regresar
            </button>
        </nav>
    </header>


    <form action="../Controller/ctrRegistro.php" class="fmlrLogin" method="post">

        <div class="campoForm">
            <label for="ipEmail" class="lbForm">Nombre(s)</label>

            <input id="ipEmail" name="nombre" type="text" class="ip" required>
        </div>
        <div class="campoForm">
            <label for="ipEmail" class="lbForm">Apellidos</label>

            <input id="ipEmail" name="apellido" type="text" class="ip" required>
        </div>

        <div class="campoForm">
            <label for="ipEmail" class="lbForm">Correo Electronico</label>

            <input id="ipEmail" name="correo" type="email" class="ip" required>
        </div>

        <div class="campoForm">
            <label for="ipPwd" class="lbForm">Contraseña</label>

            <input id="ipPwd"  name="password" type="password" class="ip" required>
        </div>
        <div class="campoForm">
            <label for="ipPwd" class="lbForm">Comfirmar Contraseña</label>

            <input name="confirmar_password" id="ipPwd2" type="password" class="ip" required>
        </div>
        <div class="campoTerminos">
            <label for="chbox" class="lbTerminos">
                <a id="chbox" href="">Acepta Terminos y Condiciones</a>
            </label>
            
            <input type="checkbox" name="terminos" id="" required>
        </div>
        <div class="campoBtns">
            <label for="" class="lbBtns">
                <input type="submit" value="Enviar" class="btnEnviar" required>
            </label>
        </div>
    </form>
</body>
</html>