<?php
require_once("Usuario.php");
require_once("SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
} 

$id = $_GET['id'];
$nombre="";
$correo="";

$usuarioAmodif;

$usuarios = SelectorPersistente::getUsuarioPersistente()->listar();
foreach ($usuarios as $key => $usuario){
    if($usuario->getId_usuario() == $id){
        $usuarioAmodif = $usuario;
    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST"){

    if(!$_POST["nombre"]==""){
        $nombre = ($_POST["nombre"]);
    }
    if(!$_POST["correo"]==""){
        $correo = $_POST["correo"];
    }else{
        $correo = $usuarioAmodif->getCorreo();
    }

    $usuario = new Usuario($id,$nombre,$correo,$usuarioAmodif->getPassword());
    SelectorPersistente::getUsuarioPersistente()->modificar($usuario);

            header("location:listarUsuarios.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    <title>Modificar usuario</title>
</head>
<body>
    <div class="modif">
        <h2>Introduce los nuevos datos del usuario</h2>
        <form action="" method="post">

            <br>
            <label>Nombre Usuario</label>
            <input class="inpt" type="text" name="nombre" id="nombre"  value="<?=$usuarioAmodif->getNombre();?>">
            <br>
            <label>Correo</label>
            <input class="inpt" type="email" name="correo" id="correo" value="<?=$usuarioAmodif->getCorreo()?>">
            <br>
            <input class="boton" type="submit" value="Modificar">

            
                
        </form>
    </div>
</body>
</html>