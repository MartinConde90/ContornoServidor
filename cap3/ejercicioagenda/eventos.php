<?php
require_once("Evento.php");
$mensaje = "";
if(!isset($_SESSION)) 
{ 
    session_start(); 
    
} 

$eventos = [];
if(isset($_SESSION['eventos'])){
    $eventos =  unserialize($_SESSION['eventos']);
}

if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["nombre"])&& isset($_POST["fecha_ini"])&& isset($_POST["fecha_fin"]) ) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];
    
        $eventos[] = new Evento($id,$nombre,new DateTime($fecha_ini),new DateTime($fecha_fin),$_SESSION["usuario"]["idUsuario"]);

            /*
            $_SESSION["id_evento"] = $eventonew->getId_evento();
            $_SESSION["nombreevento"] = $eventonew->getNombre();
            $_SESSION["fechainicio"] = $eventonew->getFecha_inicio();
            $_SESSION["fechafin"] = $eventonew->getFecha_fin();
            $_SESSION["id_usuario"] = $eventonew->getId_usuario();
            $array = array($_SESSION["id_evento"],$_SESSION["nombreevento"],$_SESSION["fechainicio"],$_SESSION["fechafin"],$_SESSION["id_usuario"]);
            */
            $_SESSION['eventos'] =  serialize($eventos);


            
    header("location:agenda.php");
    //var_dump($_SESSION['eventos']);
    
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
                <input class="inpt" type="text" name="id" id="id" required placeholder="ID numérico del evento">
                <input class="inpt" type="text" name="nombre" id="nombre" required placeholder="Nombre del evento">
                <input class="inpt" type="datetime-local" name="fecha_ini" id="fecha_ini" required placeholder="Fecha Inicio">
                <input class="inpt" type="datetime-local" name="fecha_fin" id="fecha_fin" required placeholder="Fecha Fin">
                <input class="boton" type="submit" value="Crear">    
        </form>
    </div>
   
</body>
</html>