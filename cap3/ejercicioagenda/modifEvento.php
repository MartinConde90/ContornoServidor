<?php
require_once("Evento.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$eventos = unserialize($_SESSION['eventos']);

$id = $_GET['id'];
$nombre="";
$fecha_ini="";
$fecha_fin="";

$eventoAmodif;

foreach ($eventos as $key => $evento){
    if($evento->getId_evento() == $id){
        $eventoAmodif = $evento;
    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST"){

    if(!$_POST["nombre"]==""){
        $eventoAmodif->setNombre($_POST["nombre"]);
    }
    if(!$_POST["fecha_ini"]==""){
        $eventoAmodif->setFecha_inicio(new DateTime($_POST["fecha_ini"]));
    }
    if(!$_POST["fecha_fin"]==""){
        $eventoAmodif->setFecha_fin(new DateTime($_POST["fecha_fin"]));
    }

    $_SESSION['eventos'] =  serialize($eventos);

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
            <input class="inpt" type="text" name="nombre" id="nombre"  value="<?=$eventoAmodif->getNombre();?>">
            <br>
            <label>Fecha Inicio</label>
            <input class="inpt" type="datetime-local" name="fecha_ini" id="fecha_ini" value="<?=$eventoAmodif->getFecha_inicio()->format("d-m-Y T H:i ")?>">
            <br>
            <label>Fecha Fin</label>
            <input class="inpt" type="datetime-local" name="fecha_fin" id="fecha_fin" value="<?=$eventoAmodif->getFecha_fin()->format("d-m-Y T H:i ")?>">
            <br>
            <input class="boton" type="submit" value="Modificar">

            
                
        </form>
    </div>
</body>
</html>