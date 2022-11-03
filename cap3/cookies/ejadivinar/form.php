<?php
$mensaje = "";
$contador = 5;
$random = rand(0, 100);
if(isset($_COOKIE["contador"])){
    $contador = $_COOKIE["contador"];
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["numero"]) && isset($_COOKIE["contador"]) && $_COOKIE["contador"]>0){
    $contador--;
    setcookie("contador",$contador,time()+3600);

    if($_COOKIE["random"]==$_POST["numero"]){
        $mensaje = "Has acertado";
        setcookie("contador", "", time()-3600);
    }
    if($_COOKIE["random"]>$_POST["numero"]){
        $mensaje = "El número es mayor";
    }
    if($_COOKIE["random"]<$_POST["numero"]){
        $mensaje = "El número es menor";
    }
}
if(isset($_COOKIE["contador"]) && $_COOKIE["contador"]==0){
    $mensaje = "Has perdido";
    setcookie("contador", "", time()-3600);
}

if(!isset($_COOKIE["contador"])){
    setcookie("contador",$contador,time()+3600);
    setcookie("random",$random,time()+3600);
    $mensaje = "Introduce un numero";
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
    <p>Intentos: <?php echo $contador ?> <br> <?php echo $mensaje;?> </p>
    <?php 
        if($contador>0 && $mensaje != "Has acertado"){
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