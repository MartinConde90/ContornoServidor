<?php
require_once("email.php");
require_once("servidor.php");
$email = new Email();

if ($_SERVER["REQUEST_METHOD"]=="POST" && 
    isset($_POST["emisor"]) && $_POST["emisor"] !="" &&
    isset($_POST["asunto"]) && $_POST["asunto"] !="" &&
    isset($_POST["mensaje"]) && $_POST["mensaje"] !="") { 

    $email->datosEmail($_POST["emisor"],$_POST["asunto"],$_POST["mensaje"]);

    $enviar = new Servidor();
    $enviar->enviar($email);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Email</title>
</head>
<body>
    <div class="mensaje">
        <p>Email de prueba</p>
    </div>
    <form action="index.php" method="post">
        <input type="text" name="emisor"  autofocus placeholder="emisor" style="background-color:orange;">
        <br>
        <input type="text" name="asunto"  autofocus placeholder="asunto" style="background-color:pink;">
        <br>
        <textarea  name="mensaje" rows="4" cols="50" autofocus placeholder="Introduce tu mensaje" style="background-color:blue;"></textarea>
        <br>
        <input type="submit" name="submit">
    </form>
</body>
</html>