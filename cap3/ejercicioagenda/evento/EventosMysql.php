<?php
require_once(dirname(__FILE__)."/../evento/Evento.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
require_once(dirname(__FILE__)."/../conexion/BDMySql.php");
require_once(dirname(__FILE__)."/../PersistentInterface.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class EventosMysql extends Evento implements PersistentInterface{

    function guardar(){
        $stm = BDMySql::getConexion()->prepare("INSERT into eventos (nombre, fecha_inicio, fecha_fin, id_usuario) values(:nombre,:fecha_inicio,:fecha_fin,:id_usuario)"); 
                $stm->execute([":nombre"=>$this->getNombre(),":fecha_inicio"=>$this->getFecha_inicio()->format('Y-m-d H:i:s'),":fecha_fin"=>$this->getFecha_fin()->format('Y-m-d H:i:s'),":id_usuario"=>$this->getId_usuario()]);
    }

    static function listar(){
        $stm = BDMySql::getConexion()->prepare("SELECT * from eventos"); 
        $stm->execute();
        $eventos = [];
        while (($evento = $stm->fetch())!=null) {
            $eventos[] =  new EventosMysql($evento["nombre"],new DateTime($evento["fecha_inicio"]),new DateTime($evento["fecha_fin"]),$evento["id_usuario"],$evento["id_evento"]);
        }
        return $eventos;
    }

    function modificar(){
        $stm = BDMySql::getConexion()->prepare("UPDATE eventos SET nombre = :nombre , fecha_inicio = :fecha_inicio, fecha_fin= :fecha_fin where id_evento=:id");
        $stm->execute([":nombre"=>$this->getNombre(),":fecha_inicio"=>$this->getFecha_inicio()->format('Y-m-d H:i:s'),":fecha_fin"=>$this->getFecha_fin()->format('Y-m-d H:i:s'),":id"=>$this->getId_evento()]);
    }

    static function eliminar($id){
        $stm = BDMySql::getConexion()->prepare("DELETE from eventos where id_evento = :id ");
        $stm->execute([":id"=>$id]);
    }

}