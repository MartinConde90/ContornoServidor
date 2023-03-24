<?php
require_once("Usuario.php");
require_once("SelectorPersistente.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); 
} 

$id = $_GET['id'];

if ($_SESSION["id"] == $id) {
    echo '<script>alert("No puedes eliminarte a ti mismo");window.location.href = "listarUsuarios.php";</script>';
} else {
    $usuarios = SelectorPersistente::getUsuarioPersistenteClass()::listar();

    foreach ($usuarios as $key => $usuario) {
        if ($usuario->getId_usuario() == $id) {
            SelectorPersistente::getUsuarioPersistenteClass()::eliminar($id);
        }
    }

    header("location:listarUsuarios.php");
    exit();
}