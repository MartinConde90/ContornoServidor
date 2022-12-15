<?php
require_once("usuario.php");

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("location:login.php");
    exit();
}
/*
$hash = password_hash("12345",PASSWORD_DEFAULT);

if (password_verify("12345",$hash)) {
    echo "Acceso verificado";
} else {
    echo "acceso denegado";
}
*/

if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"]) && isset($_POST["nombre"])&& isset($_POST["apellidos"]) ) {
    try{
        $correo = $_POST["correo"];
    $passwd = password_hash($_POST["password"],PASSWORD_DEFAULT);
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $objeto = new usuario(null,$nombre,$apellidos,$correo,$passwd);

    $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
    $usuario ="root";
    $password = "root123";
    $bd = new PDO($dsn, $usuario, $password);

    $stm = $bd->prepare("INSERT INTO usuario (nombre, apellidos, email, pass) VALUES (:nombre,:apellidos,:correo,:password)"); //los dos puntos hacen referencia al nombre de la siguiente linea
    $stm->execute([":correo"=>$correo,":password"=>$passwd, ":nombre"=>$nombre,":apellidos"=>$apellidos]);
    }
    catch(Exception $e){
        echo "Error";
    }
    
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>New User</title>
</head>
<body>
    <label>Introduce un nuevo usuario</label>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required value="<?=(isset($objeto))?$objeto->getNombre():""?>">

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required value="<?=(isset($objeto))?$objeto->getApellidos():""?>">

        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" required value="<?=(isset($objeto))?$objeto->getCorreo():""?>">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"  required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>