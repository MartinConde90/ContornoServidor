<?php
require_once(dirname(__FILE__)."/../evento/Evento.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
} 
if(!isset($_SESSION["id"])){
    header("location:login.php");
}


$id = $_GET['id'];
$nombre="";
$fecha_ini="";
$fecha_fin="";

$eventoAmodif;
$eventos = SelectorPersistente::getEventoPersistenteClass()::listar();
//$eventos = SelectorPersistente::getEventoPersistente()->listar();
foreach ($eventos as $key => $evento){
    if($evento->getId_evento() == $id){
        $eventoAmodif = $evento;
    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST"){

    if(!$_POST["nombre"]==""){
        $nombre = ($_POST["nombre"]);
    }
    if(!$_POST["fecha_ini"]==""){
        $fecha_ini = new DateTime($_POST["fecha_ini"]);
    }else{
        $fecha_ini = $eventoAmodif->getFecha_inicio();
    }
    if(!$_POST["fecha_fin"]==""){
        $fecha_fin = new DateTime($_POST["fecha_fin"]);
        //echo("hola");
        $intervalo = $fecha_ini->diff($fecha_fin);
        if($intervalo->invert==1){
            $fecha_fin= null;
            //echo("hola2");
        }   
    }else{
        $fecha_fin = $eventoAmodif->getFecha_fin();
        //echo("hola3");
        $intervalo = $fecha_ini->diff($fecha_fin);
        if($intervalo->invert==1){
            $fecha_fin= null;
            //echo("hola4");
        }
    }
    
    $tipoEvento = SelectorPersistente::getEventoPersistenteClass();    
    $evento = new $tipoEvento($nombre,$fecha_ini,$fecha_fin,$_SESSION["id"],$id);
    $evento->modificar($evento);
    //$evento = new Evento($nombre,$fecha_ini,$fecha_fin,$_SESSION["id"],$id);
    //SelectorPersistente::getEventoPersistente()->modificar($evento);

            header("location:../mostrarDatos/agenda.php");
}
include("../header.php")
?>
<!--
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="../mostrarDatos/agenda.php">Listado Eventos</option>
        <option value="../añadir/eventos.php">Crear evento</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="..añadir/nuevoUsuario.php">Añadir Usuario</option>
    </select>
    <button class="cerrar" onclick="window.location.href = '../cerrarSesion.php';">Cerrar sesión</button>
    <div class="modif">
-->
        <!--
        <form action="" method="post">
            <br>
            <label>Nombre Evento</label>
            <input class="inpt" type="text" name="nombre" id="nombre"  value="<?=$eventoAmodif->getNombre();?>">
            <br>
            <label>Fecha Inicio</label>
            <input class="inpt" type="datetime-local" name="fecha_ini" id="fecha_ini" value="<?=$eventoAmodif->getFecha_inicio()->format("d-m-Y T H:i ")?>">
            <br>
            <label>Fecha Fin</label>
            <input class="inpt" type="datetime-local" name="fecha_fin" id="fecha_fin" value="<?=$eventoAmodif->getFecha_fin()->format("d-m-Y T H:i ")?>">
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
                    <h2>Introduce los nuevos datos del evento</h2>
                    <form class="d-flex justify-content-center align-items-start mx-auto" action="" method="post">
                        <div class="form-group">
                            <label class="text-light" style="margin-left:10px">Nombre Evento </label>
                            <input class="inpt form-control mx-2" style="width:200px" type="text" name="nombre" id="nombre" value="<?=$eventoAmodif->getNombre();?>">
                        </div>
                        <div class="form-group">
                            <label class="text-light" style="margin-left:10px">Fecha Inicio</label>
                            <input class="inpt form-control mx-2" style="width:200px"  type="datetime-local" name="fecha_ini" id="fecha_ini" value="<?=$eventoAmodif->getFecha_inicio()->format("d-m-Y T H:i ")?>">
                        </div>
                        <div class="form-group">
                            <label class="text-light" style="margin-left:10px">Fecha Fin</label>
                            <input class="inpt form-control mx-2" style="width:200px"  type="datetime-local" name="fecha_fin" id="fecha_fin" value="<?=$eventoAmodif->getFecha_fin()->format("d-m-Y T H:i ")?>">
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