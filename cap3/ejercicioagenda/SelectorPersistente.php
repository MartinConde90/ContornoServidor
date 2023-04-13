<?php

use function PHPSTORM_META\type;

require_once("evento/EventosSesiones.php");
require_once("evento/EventosMysql.php");
require_once("evento/EventosMongo.php");
require_once("usuario/UsuarioSesiones.php");
require_once("usuario/UsuarioMysql.php");
require_once("usuario/UsuarioMongo.php");
class SelectorPersistente{
    static private  function getTipoEvento() {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        return isset($_SESSION["sistemaGuardado"])?$_SESSION["sistemaGuardado"]:-1;
    }
/*
    static public function getEventoPersistente(){
        $obj =null;
        switch(self::getTipoEvento()){
            case 0: 
                $obj =  new EventosSessiones();
                break;
            
            case 1:
                $obj =  new EventosMysql();
                break;
            
            case 2:
                $obj =  new EventosMongo();
                break;

            default: 
            $obj =  new EventosSessiones();
            break;
        }
        return $obj;
    }
*/


    static public function getEventoPersistenteClass(){
        $obj =null;
        switch(self::getTipoEvento()){
            case 0: 
                $obj =  EventosSessiones::class;
                break;
            
            case 1:
                $obj =  EventosMysql::class;
                break;
            
            case 2:
                $obj =  EventosMongo::class;
                break;

            default: 
            $obj =  EventosSessiones::class;
            break;
        }
        return $obj;
    }
/*
    static public function getUsuarioPersistente(){
        $obj =null;
        switch(self::getTipoEvento()){
            case 0: 
                $obj =  new UsuarioSesiones();
                break;
            
            case 1:
                $obj =  new UsuarioMysql();
                break;
            
            case 2:
                $obj =  new UsuarioMongo();
                break;

            default: 
            $obj =  new UsuarioSesiones();
            break;
        }
        return $obj;
    }
*/
    static public function getUsuarioPersistenteClass(){
        $obj =null;
        switch(self::getTipoEvento()){
            case 0: 
                $obj =  UsuarioSesiones::class;
                break;
            
            case 1:
                $obj =  UsuarioMysql::class;
                break;
            
            case 2:
                $obj =  UsuarioMongo::class;
                break;

            default: 
            $obj =  UsuarioSesiones::class;
            break;
        }
        return $obj;
    }
}