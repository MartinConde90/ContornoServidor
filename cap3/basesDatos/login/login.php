<?php
require_once("usuario.php");
session_start();
$mensaje ="";
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"]) ) {
    $correo = $_POST["correo"];
    $passwd = $_POST["password"];
    $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
    $usuario ="root";
    $password = "root123";
    $bd = new PDO($dsn, $usuario, $password);
    //$sql = "select * from usuario where correo='$correo' and password='$passwd' limit 1";
    //echo $sql;
    //$datos = $bd->query($sql); //JAMAS NO USAR

    $stm = $bd->prepare("SELECT * from usuario where email = :correo limit 1"); //los dos puntos hacen referencia al nombre de la siguiente linea
    $stm->execute([":correo"=>$correo]);

    if ($stm->rowCount() == 1) {
        $_SESSION["correo"] = $correo;
        $user = $stm->fetch();
        $usuario = new Usuario($user["idusuario"],$user["nombre"],$user["apellidos"],$user["email"],$user["pass"]);

        if (!$usuario->comprobarValidarUsuario($passwd, $correo)){  //ESTO COMPRUEBA LOS DATOS QUE METE EL USUARIO CON LOS QUE HAY EN LA BASE DE DATOS, POR SI TE HA INYECTADO CODIGO
            $mensaje = "Usuario y/o contraseña incorrectos verificado";
        } else {
            $_SESSION["usuario"]["idUsuario"] = $usuario->getIdUsuario();
            $_SESSION["usuario"]["nombre"] = $usuario->getNombre();
            header("location:index.php");
            exit();
        }

        var_dump($usuario);
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
    
    <title>login</title>
</head>
<body>
    <div><?=$mensaje?></div>
    <form action="" method="post">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"  required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>