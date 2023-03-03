<?php
require_once("Evento.php");
require_once("SelectorPersistente.php");
$mensaje = "";
if(session_status() !== PHP_SESSION_ACTIVE) 
{ 
    session_start(); 
} 

$eventos = [];
if(isset($_SESSION['eventos'])){
    $eventos =  unserialize($_SESSION['eventos']);
}
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["nombre"])&& isset($_POST["fecha_ini"])&& isset($_POST["fecha_fin"]) ) {
    $nombre = $_POST["nombre"];
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"]!=""?new DateTime($_POST["fecha_fin"]):null;

    $_SESSION["sistemaGuardado"] = $_POST['sistemaguardar'];
    
            $evento = new Evento($nombre,new DateTime($fecha_ini),$fecha_fin,$_SESSION["id"]);
            SelectorPersistente::getEventoPersistente()->guardar($evento);
     
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
    <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    <title>Document</title>
</head>
<body>
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="agenda.php">Listado Eventos</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="listarUsuarios.php">Listar Usuarios</option>
        <option value="nuevoUsuario.php">Añadir Usuario</option>
    </select>
    <div class="mensaje"><?=$mensaje?></div>

    <div class="contenedor">
        <h2>Creación eventos</h2>
        <form action="" method="post">
                <input class="inpt" type="text" name="nombre" id="nombre" required placeholder="Nombre del evento">
                <input class="inpt" type="datetime-local" name="fecha_ini" id="fecha_ini" required placeholder="Fecha Inicio">
                <input class="inpt" type="datetime-local" name="fecha_fin" id="fecha_fin" placeholder="Fecha Fin">
                <select class="sistemaguardar" name="sistemaguardar" required>
                    <option value="0">Sesiones</option>
                    <option value="1">MySQL</option>
                    <option value="2">MongoDB</option>
                </select>
                <input class="boton" type="submit" value="Crear">    
        </form>
    </div>
   
</body>
</html>