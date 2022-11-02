<?php
session_start();
$contador=0;
$color = "#FFF";

if(isset($_COOKIE["contador"])){
    $contador = $_COOKIE["contador"];
}

if(!isset($_SESSION["contador"])){
    $_SESSION["contador"] = 0;
}else{
    $_SESSION["contador"]++;
}

if($_SESSION["contador"]==0){
    $_SESSION["color"]= $color;
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["color"])){
    
    //setcookie("color",$color,time()+3600);
    $color = $_POST["color"];
    //contador
    if($_SESSION["color"]!= $color ){
        $contador++;
        setcookie("contador",$contador,time()+3600);
    }
    
    $_SESSION["color"]=$color;

}else{
    if(isset($_SESSION["color"])){
        $color = $_SESSION["color"];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color de fondo y contador</title>
    <style>
        body{
            background-color: <?=$_SESSION["color"]?>;
        }
    </style>
</head>
<body>
    <p>Se ha cambiado de color <?php echo $contador?></p>
    <form action="" method="post">
        <input type="color" name="color" id="color" value="<?=$color ?>">
        <input type="submit" value="guardar">
    </form>
</body>
</html>