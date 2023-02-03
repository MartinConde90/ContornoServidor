<?php
require_once("Evento.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    $nombre = $_POST["nombre"];

    if($_POST["fecha_ini"]==""){
        $fecha =$_SESSION["fechainicio"];
    }else{
        $fecha = new DateTime($_POST["fecha_ini"]);
    }
    if($_POST["fecha_fin"]==""){
        $fechafin =$_SESSION["fechafin"];
    }else{
        $fechafin = new DateTime($_POST["fecha_fin"]);
    }


    $eventonew = new Evento(14,$nombre,$fecha,$fechafin,$_SESSION["usuario"]["idUsuario"]);

            $_SESSION["nombreevento"] = $eventonew->getNombre();
            $_SESSION["fechainicio"] = $eventonew->getFecha_inicio();
            $_SESSION["fechafin"] = $eventonew->getFecha_fin();

            header("location:agenda.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    <title>Modificar evento</title>
</head>
<body>
    <div class="modif">
        <h2>Introduce los nuevos datos del evento</h2>
        <form action="" method="post">

            <br>
            <label>Nombre Evento</label>
            <input class="inpt" type="text" name="nombre" id="nombre"  value="<?=$_SESSION["nombreevento"]?>">
            <br>
            <label>Fecha Inicio</label>
            <input class="inpt" type="datetime-local" name="fecha_ini" id="fecha_ini" value="<?=$_SESSION["fechainicio"]->format("d-m-Y T H:i ")?>">
            <br>
            <label>Fecha Fin</label>
            <input class="inpt" type="datetime-local" name="fecha_fin" id="fecha_fin" value="<?=$_SESSION["fechafin"]->format("d-m-Y T H:i ")?>">
            <br>
            <input class="boton" type="submit" value="Modificar">

            
                
        </form>
    </div>
</body>
</html>