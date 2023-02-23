<?php
require_once("PersistentInterface.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class EventosSessiones implements PersistentInterface{

    function guardar($datos){
        $eventos =[];
        if(isset($_SESSION['eventos'])){
            $eventos = unserialize($_SESSION['eventos']);
        }
       
        //var_dump($datos);
        //var_dump($eventos);
        $eventos[$datos->getId_evento()] = $datos;
        $_SESSION['eventos'] =  serialize($eventos);
    }

    function listar(){
        $eventos = [];
        if(isset($_SESSION['eventos'])){
            $eventos = unserialize($_SESSION['eventos']);
        }
        return $eventos;
    }

    function modificar($datos){
        self::guardar($datos);
    }

    function eliminar($id){
        $eventos = [];
        if(isset($_SESSION['eventos'])){
            $eventos = unserialize($_SESSION['eventos']);
        }
        unset($eventos[$id]);
        $_SESSION['eventos'] =  serialize($eventos);

    }

}