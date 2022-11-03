<?php
session_start();


$mensaje = "";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["numero"]) && isset($_SESSION["contador"]) && $_SESSION["contador"]>0){
    $_SESSION["contador"]--;
    array_push($_SESSION["historial"],$_POST["numero"]);

    if($_SESSION["random"]==$_POST["numero"]){
        $mensaje = "Has acertado";
        session_destroy();
    }
    if($_SESSION["random"]>$_POST["numero"]){
        $mensaje = "El número es mayor";
    }
    if($_SESSION["random"]<$_POST["numero"]){
        $mensaje = "El número es menor";
    }
}
if(isset($_SESSION["contador"]) && $_SESSION["contador"]==0){
    $mensaje = "Has perdido";
    session_destroy();
}

if(!isset($_SESSION["contador"])){
    $_SESSION["contador"] = 5;
    $_SESSION["random"] = rand(0, 100);
    $mensaje = "Introduce un numero";
    $_SESSION["historial"] = array();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivinar número</title>
</head>
<body>
    <p>Adivina el número</p>
    <p>Intentos: <?php echo $_SESSION["contador"]; ?> <br> <?php echo $mensaje;?> </p>
    <p>Números intentados: <?php 
                            echo implode(", ",  $_SESSION["historial"]);
                            ?>
    </p>
    <?php 
        if($_SESSION["contador"]>0 && $mensaje != "Has acertado"){
            ?>

            <form action="" method="post">
                <input type="text" name="numero" id="numero" value="">
                <input type="submit" value="enviar">
            </form>

            <?php
        }else{
            ?>
            <form action="" method="post">
                <input type="submit" value="Intentar de nuevo">
            </form>
            <?php
        }
    
    ?>
    
</body>
</html>