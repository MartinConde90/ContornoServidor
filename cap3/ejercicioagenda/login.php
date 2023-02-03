<?php
require_once("Usuario.php");
$mensaje = "";
if(!session_start()){
    session_start();
}
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"]) ) {
    $correo = $_POST["correo"];
    $passwd = $_POST["password"];

    $usuarionew = new Usuario(1,"martin","martinconde@gmail.com",1234,1,false);

    if($usuarionew->getCorreo() == $correo && $usuarionew->getPassword() == $passwd){
        $mensaje =  "usuario correcto";
            $_SESSION["correo"] = $correo;
            $_SESSION["usuario"]["idUsuario"] = $usuarionew->getId_usuario();
            $_SESSION["usuario"]["nombre"] = $usuarionew->getNombre();
        header("location:index.php");
        exit();
    } else {
        $mensaje = "Usuario y/o contraseña incorrectos";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mensaje"><?=$mensaje?></div>

    <div class="contenedor">
        <h2>Inicio de sesión</h2>
        <form action="" method="post">
                <input class="inpt" type="email" name="correo" id="correo" required placeholder="Correo de usuario">
                <input class="inpt" type="password" name="password" id="password" required placeholder="Contraseña">
                <input class="boton" type="submit" value="Entrar">    
        </form>
    </div>
   
</body>
</html>