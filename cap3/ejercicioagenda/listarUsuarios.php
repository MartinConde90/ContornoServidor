<?php
require_once("Usuario.php");
require_once("SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){ 
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
        <option value="agenda.php">Listado Eventos</option>
        <option value="eventos.php">Crear evento</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="nuevoUsuario.php">Añadir Usuario</option>

    </select>
    
    <table>
        <tr>
            <td>ID</td>
            <td>nombre</td>
            <td>Email</td>
        </tr>
        <?php
                 $usuarios = SelectorPersistente::getUsuarioPersistente()->listar();
                 //var_dump($usuarios);
                foreach ($usuarios as $id => $usuario) {
        //for($i=0; $i< count($eventos); $i++){
                 ?>
        <tr>
            <td><?= $usuario->getId_usuario() ?></td>
            <td><?= $usuario->getNombre() ?></td>
            <td><?= $usuario->getCorreo() ?></td>
            <td><a  href="modifUsuarios.php?id=<?= $usuario->getId_usuario() ?>">Modificar usuario</a></td>
            <td><a  href="eliminarUsuarios.php?id=<?= $usuario->getId_usuario() ?>" onclick="javascript:return confirm('Estás seguro de eliminar este usuario?')">Eliminar usuario</a></td>
        </tr>
        <?php }?>
    </table>
</body>
</html>