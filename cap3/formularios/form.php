<?php
require_once("Alumno.php");
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario login</title>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $alumno = new Alumno($_POST['nombre'],$_POST['apellidos'],$_POST['nif'],$_POST['sexo']);
        echo $alumno;
    }
    else{
        ?>
        <form action="form.php" method="post">
        <input name="nombre" type="text">
        <input name="apellidos" type="text">
        <input name="nif" type="text">
        <input name="sexo" type="text">
        <input name="enviar" type="submit">
    </form>
    <?php
    }
    ?>
</body>