<?php
require_once("Usuario.php");
require_once("SelectorPersistente.php");
$mensaje = "";
if(session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}
if(!isset($_SESSION["id"])){
    header("location:login.php");
}

$usuarios = [];
if(isset($_SESSION['usuarios'])){
    $usuarios =  unserialize($_SESSION['usuarios']);
}

if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["correo"])&& isset($_POST["password"])&& isset($_POST["nombre"])&& isset($_POST["rol"]) ) {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];

    $_SESSION["sistemaGuardado"] = $_POST['sistemaguardar'];
    $TipoUsuario = SelectorPersistente::getUsuarioPersistenteClass();
    $usuario = new $TipoUsuario($nombre,$correo,$password,$rol,true);
    $usuario->guardar($usuario);

    //$usuario = new Usuario($nombre,$correo,$password);
    //SelectorPersistente::getUsuarioPersistente()->guardar($usuario);

    header("location:listarUsuarios.php");
    exit();
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
        <option value="eventos.php">Crear evento</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="listarUsuarios.php">Listar usuarios</option>
    </select>
    <button class="cerrar" onclick="window.location.href = 'cerrarSesion.php';">Cerrar sesión</button>
    
    <div class="mensaje"><?=$mensaje?></div>
        <h2>Añadir usuario</h2>
        <form action="" method="post">
            <input class="inpt" type="text" name="nombre" id="nombre" required placeholder="Nombre de usuario">
            <input class="inpt" type="email" name="correo" id="correo" required placeholder="Correo de usuario">
            <input class="inpt" type="password" name="password" id="password" required placeholder="Contraseña">
            <input class="inpt" type="number" min="0" max="1" name="rol" id="rol" required>
            <select class="sistemaguardar" name="sistemaguardar" required>
                <option value="0">Sesiones</option>
                <option value="1">MySQL</option>
                <option value="2">MongoDB</option>
            </select>
            <input class="boton" type="submit" value="Registrar">    
        </form>
    </div>
   
</body>
</html>