<?php
session_start();

if(isset($_SESSION["correo"])){
    $id = $_GET['id'];
    $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
    $usuario ="root";
    $password = "root123";
    $bd = new PDO($dsn, $usuario, $password);
    $stm = $bd->prepare("SELECT * from usuario where idusuario = :id limit 1"); //los dos puntos hacen referencia al nombre de la siguiente linea
    $stm->execute([":id"=>$id]);
    $user = $stm->fetch();

    
        if($_SERVER["REQUEST_METHOD"]== "POST"){
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $correo = $_POST["correo"];

            if($_POST["nombre"] == "") $nombre = $user["nombre"];
            if($_POST["apellidos"] == "") $apellidos = $user["apellidos"];
            if($_POST["correo"] == "") $correo = $user["email"];

            $stm = $bd->prepare("UPDATE usuario SET nombre='$nombre', apellidos='$apellidos', email='$correo' where  idusuario = :id"); //los dos puntos hacen referencia al nombre de la siguiente linea
            $stm->execute([":id"=>$id]);
            header("location:tablaUsuarios.php");
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
    <label>Introduce los nuevos datos de usuario</label>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= $user["nombre"]?>">

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" value="<?=$user["apellidos"]?>">

        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" value="<?=$user["email"]?>">

        <input type="submit" value="Entrar">
    </form>
</body>
</html>