<?php
require_once("Evento.php");
require_once("SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){ 
    session_start();  
} 
if(!isset($_SESSION["id"])){
    header("location:index.php");
}
//var_dump($eventos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Calendario</title> 
<link rel="stylesheet" type="text/css" href="calendario.css" media="all" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="calendario.js"></script>
<link rel="stylesheet" type="text/css" href="css.css" media="screen" />
<link rel="stylesheet" type="text/css" href="calendario.css" media="screen" />
</head>
<body>
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="eventos.php">Crear Eventos</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Opciones</option>
        <option value="listarUsuarios.php">Listar Usuarios</option>
        <option value="nuevoUsuario.php">Añadir Usuario</option>
    </select>
    <button class="cerrar" onclick="window.location.href = 'cerrarSesion.php';">Cerrar sesión</button>

    <h1>Calendario de eventos</h1>
    <br/><br/>
    <div id="calendario">
    <div id="anterior" onclick="mesantes()"></div>
    <div id="posterior" onclick="mesdespues()"></div>
    <h2 id="titulos"></h2>
    

    <script>
        tableCreate();
    </script>
    <div id="fechaactual"><i onclick="actualizar()">HOY: </i></div>
    <div id="buscafecha">
        <form action="#" name="buscar">
        <p>Buscar ... MES
            <select name="buscames">
            <option value="0">Enero</option>
            <option value="1">Febrero</option>
            <option value="2">Marzo</option>
            <option value="3">Abril</option>
            <option value="4">Mayo</option>
            <option value="5">Junio</option>
            <option value="6">Julio</option>
            <option value="7">Agosto</option>
            <option value="8">Septiembre</option>
            <option value="9">Octubre</option>
            <option value="10">Noviembre</option>
            <option value="11">Diciembre</option>
            </select>
        ... AÑO ...
            <input type="text" name="buscaanno" maxlength="4" size="4" />
        ... 
            <input type="button" value="BUSCAR" onclick="mifecha()" />
        </p>
        </form>
    </div>
    </div>
</body>
</html>