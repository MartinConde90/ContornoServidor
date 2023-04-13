<?php
require_once(dirname(__FILE__)."/../usuario/Usuario.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
} 
if(!isset($_SESSION["id"])){
    header("location:login.php");
}

$id = $_GET['id'];
$nombre="";
$correo="";

$usuarioAmodif;

$usuarios = SelectorPersistente::getUsuarioPersistenteClass()::listar();
//$usuarios = SelectorPersistente::getUsuarioPersistente()::listar();

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
    if(empty($_POST["rol"])){
        $rol = $_POST["rol"];
        //echo("hola");
    }else{
        $rol = $usuarioAmodif->getRol();
        //echo("adios");
    }

    $TipoUsuario = SelectorPersistente::getUsuarioPersistenteClass();
    $usuario = new $TipoUsuario($nombre,$correo,$usuarioAmodif->getPassword(),$rol,false,$id);
    $usuario->modificar($usuario);

    //$usuario = new Usuario($nombre,$correo,$usuarioAmodif->getPassword(),$rol,false,$id);
    //SelectorPersistente::getUsuarioPersistente()->modificar($usuario);

            header("location:../mostrarDatos/listarUsuarios.php");
}
include("../header.php");
?>

<!--
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="agenda.php">Listado Eventos</option>
        <option value="eventos.php">Crear evento</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="listarUsuarios.php">Listar usuarios</option>
        <option value="nuevoUsuario.php">Añadir Usuario</option>
    </select>
    <button class="cerrar" onclick="window.location.href = '../cerrarSesion.php';">Cerrar sesión</button>

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
            <input class="inpt" type="number" min="0" max="1" name="rol" id="rol" value="<?=$usuarioAmodif->getRol()?>">
            <br>
            <input class="boton" type="submit" value="Modificar">

            
                
        </form>
    </div>
-->
<section class="intro">
  <div class="bg-image h-100" style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
    <div class="mask d-flex justify-content-center align-items-center h-100">
      <div class="container">
            <div class="card mask-custom">

              
                  <h2>Introduce los nuevos datos del usuario</h2>
                  <form class="d-flex justify-content-center align-items-start mx-auto" action="" method="post">
                    <div class="form-group">
                      <label class="text-light" style="margin-left:10px">Nombre de usuario</label>
                      <input class="inpt form-control mx-2" style="width:200px" type="text" name="nombre" id="nombre" value="<?=$usuarioAmodif->getNombre();?>">    
                    </div>
                    <div class="form-group">
                      <label class="text-light" style="margin-left:10px">EMAIL</label>
                      <input class="inpt form-control mx-2" style="width:200px" type="email" name="correo" id="correo" value="<?=$usuarioAmodif->getCorreo()?>">
                    </div>
                    <div class="form-group">
                      <label class="text-light" style="margin-left:10px">ROL</label>
                      <input class="inpt form-control mx-2" style="width:200px" type="number" min="0" max="1" name="rol" id="rol" value="<?=$usuarioAmodif->getRol()?>">
                    </div>
                    <div class="form-group d-flex justify-content-start" style="margin-top:25px">
                      <div>
                        <input class="boton" type="submit" value="Modificar">
                      </div>
                    </div>
                  </form>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>