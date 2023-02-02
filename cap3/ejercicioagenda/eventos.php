<?php
require_once("Evento.php");
$mensaje = "";
session_start();
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["nombre"])&& isset($_POST["fecha_ini"])&& isset($_POST["fecha_fin"]) ) {
    $nombre = $_POST["nombre"];
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];

    //echo $fecha_ini;
    
    $fecha = new DateTime($fecha_ini);
    $fechafin = new DateTime($fecha_fin);
    //echo "<br>".$fecha->format("d-m-Y T H:i ");
    //echo "<br>".$fechafin->format("d-m-Y T H:i ");
    

    $eventonew = new Evento(14,$nombre,$fecha,$fecha,$_SESSION["usuario"]["idUsuario"]);
            $_SESSION["id_evento"] = $eventonew->getId_evento();
            $_SESSION["nombreevento"] = $eventonew->getNombre();
            $_SESSION["fechainicio"] = $eventonew->getFecha_inicio();
            $_SESSION["fechafin"] = $eventonew->getFecha_fin();


            
    header("location:agenda.php");
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mensaje"><?=$mensaje?></div>

    <div class="contenedor">
        <h2>Creación eventos</h2>
        <form action="" method="post">
                <input class="inpt" type="text" name="nombre" id="nombre" required placeholder="Nombre del evento">
                <input class="inpt" type="datetime-local" name="fecha_ini" id="fecha_ini" required placeholder="Fecha Inicio">
                <input class="inpt" type="datetime-local" name="fecha_fin" id="fecha_fin" required placeholder="Fecha Fin">
                <input class="boton" type="submit" value="Crear">    
        </form>
    </div>
   
</body>
</html>