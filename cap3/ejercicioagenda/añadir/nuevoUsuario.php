<?php
require_once(dirname(__FILE__)."/../usuario/Usuario.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
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

    header("location:../mostrarDatos/listarUsuarios.php");
    exit();
}
include("../header.php")
?>




<!--
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="../mostrarDatos/agenda.php">Listado Eventos</option>
        <option value="eventos.php">Crear evento</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Nuevo Usuario</option>
        <option value="../mostrarDatos/listarUsuarios.php">Listar usuarios</option>
    </select>
    <button class="cerrar" onclick="window.location.href = '../cerrarSesion.php';">Cerrar sesión</button>
-->   
    


    <section class="intro">
    <div class="bg-image h-100" style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card mask-custom">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-borderless text-white mb-0">
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
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   
</body>
</html>