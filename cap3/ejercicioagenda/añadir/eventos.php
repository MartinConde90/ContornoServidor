<?php
require_once(dirname(__FILE__)."/../evento/Evento.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
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
            $TipoEvento = SelectorPersistente::getEventoPersistenteClass();
            $evento = new $TipoEvento($nombre,new DateTime($fecha_ini),$fecha_fin,$_SESSION["id"]);
            $evento->guardar($evento);
            //$evento = new Evento($nombre,new DateTime($fecha_ini),$fecha_fin,$_SESSION["id"]);
           // SelectorPersistente::getEventoPersistente()->guardar($evento);
     
    header("location:../mostrarDatos/agenda.php");
    //var_dump($_SESSION['eventos']);
    
}
include("../header.php")
?>


<!--
    <select class="menus" onchange="location = this.value;">
        <option>Crear Eventos</option>
        <option value="../mostrarDatos/agenda.php">Listado Eventos</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="../mostrarDatos/listarUsuarios.php">Listar Usuarios</option>
        <option value="nuevoUsuario.php">Añadir Usuario</option>
    </select>
    <button class="cerrar" onclick="window.location.href = '../cerrarSesion.php';">Cerrar sesión</button>
-->
    <div class="mensaje"><?=$mensaje?></div>

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