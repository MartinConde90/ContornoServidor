<?php
require_once("Usuario.php");
require_once("SelectorPersistente.php");
require_once("BDMySql.php");
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

        $usuarios = SelectorPersistente::getUsuarioPersistente()->listar();
        //var_dump($usuarios);
        foreach ($usuarios as $id => $usuario) {

            if($usuario->getCorreo() == $correo && $usuario->getPassword() == $passwd){
                $_SESSION["correo"] = $correo;
                $_SESSION["id"] = $usuario->getId_usuario();
                header("location:index.php");
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
</head>
<body>
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
   
</body>
</html>