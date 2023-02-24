<?php
require_once("EventosSesiones.php");
require_once("UsuarioSesiones.php");
class SelectorPersistente{
    static private  function getTipoEvento() {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        return $_SESSION["sistemaGuardado"];
    }

    static public function getEventoPersistente(){
        $obj =null;
        switch(self::getTipoEvento()){
            case 0: 
                $obj =  new EventosSessiones();
                break;
            
            case 1:
               // $obj =  new EventosMysql();
                break;
            
            case 2:
                //$obj =  new EventosMongo();
                break;

            default: 
            $obj =  new EventosSessiones();
            break;
        }
        return $obj;
    }

    static public function getUsuarioPersistente(){
        $obj =null;
        switch(self::getTipoEvento()){
            case 0: 
                $obj =  new UsuarioSesiones();
                break;
            
            case 1:
               // $obj =  new EventosMysql();
                break;
            
            case 2:
                //$obj =  new EventosMongo();
                break;

            default: 
            $obj =  new UsuarioSesiones();
            break;
        }
        return $obj;
    }
}