<?php
require_once("usuario.php");
session_start();
$mensaje ="";
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"]) ) {
    $correo = $_POST["correo"];
    $passwd = $_POST["password"];
    $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
    $usuar ="root";
    $password = "root123";
    $bd = new PDO($dsn, $usuar, $password);
    //$sql = "select * from usuario where correo='$correo' and password='$passwd' limit 1";
    //echo $sql;
    //$datos = $bd->query($sql); //JAMAS NO USAR

    $stm = $bd->prepare("SELECT * from usuario where email = :correo limit 1"); //los dos puntos hacen referencia al nombre de la siguiente linea
    $stm->execute([":correo"=>$correo]);

    if ($stm->rowCount() == 1) {
        
        $user = $stm->fetch();
        $usuario = new Usuario($user["idusuario"],$user["nombre"],$user["apellidos"],$user["email"],$user["pass"]);

        $verify = $usuario->comprobarValidarUsuario($passwd, $correo);
        
        if (!$verify){  //ESTO COMPRUEBA LOS DATOS QUE METE EL USUARIO CON LOS QUE HAY EN LA BASE DE DATOS, POR SI TE HA INYECTADO CODIGO
            $mensaje = "Usuario y/o contraseña incorrectos";
        } else {
            $_SESSION["correo"] = $correo;
            $_SESSION["usuario"]["idUsuario"] = $usuario->getIdUsuario();
            $_SESSION["usuario"]["nombre"] = $usuario->getNombre();
            header("location:index.php");
            exit();
        }

        //var_dump($usuario);

    } else {
        $mensaje = "Usuario y/o contraseña incorrectos";
    }


}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    <title>login</title>

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