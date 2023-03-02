<?php
require_once("PersistentInterface.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class EventosMysql implements PersistentInterface{

    function guardar($datos){
        
    }

    function listar(){
        
    }

    function modificar($datos){
        self::guardar($datos);
    }

    function eliminar($id){
        

    }

}