<?php
$contador=0;
$color = "#FFF";
if(isset($_COOKIE["contador"])){
    $contador = $_COOKIE["contador"];
}
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["color"])){
    $color = $_POST["color"];
    setcookie("color",$color,time()+3600);
    //contador
    if(isset($_COOKIE["color"]) && $_COOKIE["color"]!= $color ){
        $contador++;
        setcookie("contador",$contador,time()+3600);
    }

}else{
    if(isset($_COOKIE["color"])){
        $color = $_COOKIE["color"];
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
            background-color: <?=$color ?>;
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