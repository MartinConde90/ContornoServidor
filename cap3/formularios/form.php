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

        if($alumno->getNif()){
            echo $alumno;
        }
        else{
            ?>
            <p>NIF incorrecto</p>
            <form action="form.php" method="post">
            <input name="nombre" type="text" placeholder="Nombre">
            <input name="apellidos" type="text" placeholder="Apellidos">
            <input name="nif" type="text" placeholder="NIF">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo">
                <option value="mujer">mujer</option>
                <option value="hombre">hombre</option>
                <option value="otro">otro</option>
            </select>
            <input name="enviar" type="submit">
            </form>
            <?php
        }
        
    }
    else{
        include_once("formulario.php");
    }
    ?>
</body>