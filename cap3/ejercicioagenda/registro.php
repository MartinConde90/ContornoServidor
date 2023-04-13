<?php
require_once("usuario/Usuario.php");
require_once("SelectorPersistente.php");
require_once("conexion/BDMySql.php");
require_once("conexion/BDMongo.php");
$mensaje = "";
if(session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}

$usuarios = [];
if(isset($_SESSION['usuarios'])){
    $usuarios =  unserialize($_SESSION['usuarios']);
}

if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"])&& isset($_POST["nombre"]) ) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $_SESSION["sistemaGuardado"] = $_POST['sistemaguardar'];
    $TipoUsuario = SelectorPersistente::getUsuarioPersistenteClass();
    $usuario = new $TipoUsuario($nombre,$correo,$password,0,true);
    $usuario->guardar($usuario);

    //$usuario = new Usuario($nombre,$correo,$password,true);
    //SelectorPersistente::getUsuarioPersistente()->guardar($usuario);
    
    header("location:index.php");
    exit();
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" 
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" 
        crossorigin="anonymous">
    </script>
</head>
<body>
<section class="intro">
    <div class="bg-image h-100" style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
        <div class="mask d-flex justify-content-center align-items-center h-100">
            <div class="container">
                <div class="card mask-custom">
                    <div class="mensaje"><?=$mensaje?></div>
                        <h2>Registro de usuario</h2>
                        <form action="" method="post">
                            <input class="inpt" type="text" name="nombre" id="nombre" required placeholder="Nombre de usuario">
                            <input class="inpt" type="email" name="correo" id="correo" required placeholder="Correo de usuario">
                            <input class="inpt" type="password" name="password" id="password" required placeholder="Contraseña">
                            <select class="sistemaguardar" name="sistemaguardar" required>
                                <option value="0">Sesiones</option>
                                <option value="1">MySQL</option>
                                <option value="2">MongoDB</option>
                            </select>
                            <input class="boton" type="submit" value="Registrar">    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>