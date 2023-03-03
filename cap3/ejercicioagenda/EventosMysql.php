<?php
require_once("PersistentInterface.php");
require_once("BDMySql.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class EventosMysql implements PersistentInterface{

    function guardar($datos){
        $stm = BDMySql::getConexion()->prepare("INSERT into eventos (nombre, fecha_inicio, fecha_fin, id_usuario) values(:nombre,:fecha_inicio,:fecha_fin,:id_usuario)"); 
                $stm->execute([":nombre"=>$datos->getNombre(),":fecha_inicio"=>$datos->getFecha_inicio()->format('Y-m-d H:i:s'),":fecha_fin"=>$datos->getFecha_fin()->format('Y-m-d H:i:s'),":id_usuario"=>$datos->getId_usuario()]);
    }

    function listar(){
        $stm = BDMySql::getConexion()->prepare("SELECT * from eventos"); 
        $stm->execute();
        $eventos = [];
        while (($evento = $stm->fetch())!=null) {
            $eventos[] =  new Evento($evento["nombre"],new DateTime($evento["fecha_inicio"]),new DateTime($evento["fecha_fin"]),$evento["id_usuario"],$evento["id_evento"]);
        }
        return $eventos;
    }

    function modificar($datos){
        $stm = BDMySql::getConexion()->prepare("UPDATE eventos SET nombre = :nombre , fecha_inicio = :fecha_inicio, fecha_fin= :fecha_fin where id_evento=:id");
        $stm->execute([":nombre"=>$datos->getNombre(),":fecha_inicio"=>$datos->getFecha_inicio()->format('Y-m-d H:i:s'),":fecha_fin"=>$datos->getFecha_fin()->format('Y-m-d H:i:s'),":id"=>$datos->getId_evento()]);
    }

    function eliminar($id){
        $stm = BDMySql::getConexion()->prepare("DELETE from eventos where id_evento = :id ");
        $stm->execute([":id"=>$id]);
    }

}