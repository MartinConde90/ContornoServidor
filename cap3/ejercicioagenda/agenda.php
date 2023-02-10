<?php
require_once("Evento.php");
if(!isset($_SESSION)) 
{ 
    session_start();  
} 


//var_dump($eventos);
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
        <option value="eventos.php">Crear Eventos</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option>Usuarios</option>
        <option value="#">Añadir Usuario</option>
        <option value="#">Modificar Usuario</option>
        <option value="#">Eliminar Usuario</option>
    </select>
    
    <table>
        <tr>
            <td>nombre</td>
            <td>fecha_inicio</td>
            <td>fecha_fin</td>
        </tr>
        <?php
            if(isset($_SESSION['eventos'])){
                $eventos = unserialize($_SESSION['eventos']);
                foreach ($eventos as $id => $evento) {
        //for($i=0; $i< count($eventos); $i++){
                 ?>
        <tr>
            <td><?= $evento->getNombre() ?></td>
            <td><?= $evento->getFecha_inicio()->format("d-m-Y H:i ") ?></td>
            <td><?= $evento->getFecha_fin()->format("d-m-Y H:i ") ?></td>
            <td><a  href="modifEvento.php?id=<?= $evento->getId_evento() ?>">Modificar evento</a></td>
        </tr>
        <?php }} ?>
    </table>
</body>
</html>