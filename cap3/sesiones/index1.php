<?php
session_start();

if(!isset($_SESSION["contador"])){
    $_SESSION["contador"] = 0;
}else{
    $_SESSION["contador"]++;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador sesion</title>
</head>
<body>
    
    <p>Esta página se ha recargado <?=$_SESSION["contador"]?></p>
</body>
</html>