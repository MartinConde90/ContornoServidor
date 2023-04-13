<?php
require_once(dirname(__FILE__)."/../evento/Evento.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
} 


$id = $_GET['id'];

$eventos = SelectorPersistente::getEventoPersistenteClass()::listar();
//$eventos = SelectorPersistente::getEventoPersistente()->listar();
foreach ($eventos as $key => $evento){
    if($evento->getId_evento() == $id){
        SelectorPersistente::getEventoPersistenteClass()::eliminar($id);
        //SelectorPersistente::getEventoPersistente()->eliminar($id);
    }
}
header("location:../mostrarDatos/agenda.php");
    exit();

