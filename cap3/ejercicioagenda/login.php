<?php
require_once("usuario/Usuario.php");
require_once("SelectorPersistente.php");
require_once("conexion/BDMySql.php");
$mensaje = "";
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
//$usuario = new Usuario("martin","martinconde@gmail.com","1234",1);
//            SelectorPersistente::getUsuarioPersistente()->guardar($usuario);
/*
$usuarios = [];
if(isset($_SESSION['usuarios'])){
    $usuarios =  unserialize($_SESSION['usuarios']);
}

if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"])&& isset($_POST["nombre"])&& isset($_POST["id"]) ) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $usuario = new Usuario(001,"martin","martinconde@gmail.com","1234",1);
            SelectorPersistente::getUsuarioPersistente()->guardar($usuario); 
}
*/ 
//var_dump($usuarios);

    if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"]) ) {

        $correo = $_POST["correo"];
        $passwd = $_POST["password"];
        $_SESSION["sistemaGuardado"] = $_POST['sistemaguardar'];

        $usuarios = SelectorPersistente::getUsuarioPersistenteClass()::listar();
        //var_dump($usuarios);
        //$usuarios = SelectorPersistente::getUsuarioPersistente()->listar();

        foreach ($usuarios as $id => $usuario) {
            
            if($usuario->comprobarValidarUsuario($correo,$passwd)){
                $_SESSION["correo"] = $correo;
                $_SESSION["id"] = $usuario->getId_usuario();
                header("location:mostrarDatos/agenda.php");
                exit();
            }else{
                $mensaje = "Usuario no encontrado";
            }
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
                    <div class="contenedor">
                        <h2>Inicio de sesión</h2>
                        <form action="" method="post">
                                <input class="inpt" type="email" name="correo" id="correo" required placeholder="Correo de usuario">
                                <input class="inpt" type="password" name="password" id="password" required placeholder="Contraseña">
                                <select class="sistemaguardar" name="sistemaguardar" required>
                                    <option value="0">Sesiones</option>
                                    <option value="1">MySQL</option>
                                    <option value="2">MongoDB</option>
                                </select>
                                <input class="boton" type="submit" value="Entrar">    
                        </form>
                        <a  href="registro.php">Registrarse</a></td>
                    </div>
                </div>
            </div>
        </div>
</section>
</body>
</html>