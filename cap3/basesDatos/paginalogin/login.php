<?php
session_start();
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["nombre"]) && $_POST["nombre"] !="" 
                                       && isset($_POST["pass"]) && $_POST["pass"] !="" 
                                       && isset($_POST["email"]) && $_POST["email"] !=""){ 
    include 'conection.php';
    foreach($datos as $d){
        $_SESSION["usuario"] = $d["email"];
        include 'usuario.php';
        $datos = new Usuario($d["nombre"],$d["email"],$d["pass"]);

        header("location:privado.php");
        exit();
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
    <form action="" method="post">
        <input name="nombre" type="text" placeholder="Usuario">
        <input name="email" type="email" placeholder="Email">
        <input type="password" name="pass" placeholder="Contraseña">
        <input type="submit" name="submit">
    </form>
    
</body>
</html>