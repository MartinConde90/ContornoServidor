<?php
require_once("Usuario.php");
require_once("SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
} 


$id = $_GET['id'];

$usuarios = SelectorPersistente::getUsuarioPersistente()->listar();
foreach ($usuarios as $key => $usuario){
    if($usuario->getId_usuario() == $id){
        SelectorPersistente::getUsuarioPersistente()->eliminar($id);
    }
}
include("listarUsuarios.php");