<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
<<<<<<< HEAD
$mensaje="";
if (!isset($_SESSION["correo"])) {
    header("location:login.php");
    exit();
}else{
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
                try{
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
                catch(Exception $e){
                    $mensaje="Error, el email ya existe en la base de datos";
                }
=======

if (!isset($_SESSION["correo"])) {
    header("location:login.php");
    exit();
}else{
    if(isset($_SESSION["correo"])){
        $id = $_GET['id'];
        $dsn = "mysql:host=localhost;dbname=usuarios";
        $usuario ="root";
        $password = "";
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
>>>>>>> 0e3ebe9adf01e11c96ceb93db185253e2f1841b4
            }
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
    <title>New User</title>
</head>
<body>
<<<<<<< HEAD
    <a class="registrar" href="tablaUsuarios.php">Home</a></td>
    
    <div class="contenedor">
    <h2 class="alerta"><?= $mensaje; ?></h2>
=======
    <div class="contenedor">
>>>>>>> 0e3ebe9adf01e11c96ceb93db185253e2f1841b4
        <h2>Introduce los nuevos datos de usuario</h2>
        <form action="" method="post">

            <input class="inpt" type="text" name="nombre" id="nombre"  placeholder="Nombre" value="<?= $user["nombre"]?>">

            <input class="inpt" type="text" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?=$user["apellidos"]?>">

            <input class="inpt" type="text" name="correo" id="correo" placeholder="Correo de usuario"  value="<?=$user["email"]?>">

<<<<<<< HEAD
            <input class="boton" type="submit" value="Guardar">
=======
            <input class="boton" type="submit" value="Entrar">
>>>>>>> 0e3ebe9adf01e11c96ceb93db185253e2f1841b4
        </form>
    </div>
</body>
</html>