<?php
require_once("PersistentInterface.php");
require_once("Evento.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class EventosSessiones extends Evento implements PersistentInterface{

    function guardar(){
        $eventos =[];
        if(isset($_SESSION['eventos'])){
            $eventos = unserialize($_SESSION['eventos']);
        }
        //var_dump($eventos);

       if(empty($eventos)){
        $this->setId_evento(1);
       }else{
            $ids=[];
            for($i=1; $i<=count($eventos); $i++){
                array_push($ids,$eventos[$i]->getId_evento());
            }
            $this->setId_evento(max($ids)+1);
       }


        
        $eventos[$this->getId_evento()] = $this;
        $_SESSION['eventos'] =  serialize($eventos);
    }

    static function listar(){
        $eventos = [];
        if(isset($_SESSION['eventos'])){
            $eventos = unserialize($_SESSION['eventos']);
        }
        return $eventos;
    }

    function modificar(){
        $eventos =[];
        $eventos = unserialize($_SESSION['eventos']);
        $eventos[$this->getId_evento()] = $this;
        $_SESSION['eventos'] =  serialize($eventos);
    }

    static function eliminar($id){
        $eventos = [];
        if(isset($_SESSION['eventos'])){
            $eventos = unserialize($_SESSION['eventos']);
        }
        unset($eventos[$id]);
        $_SESSION['eventos'] =  serialize($eventos);

    }


    function __serialize(): array
    {
        return [
        "id_evento"=>$this->id_evento,
        "id_usuario"=>$this->id_usuario,
        "nombre"=>$this->nombre,
        "fecha_inicio"=>$this->fecha_inicio,
        "fecha_fin"=>$this->fecha_fin];
    }

    function __unserialize(array $data): void
    {
        $this->id_evento = $data["id_evento"];
        $this->id_usuario = $data["id_usuario"];
        $this->nombre = $data["nombre"];
        $this->fecha_inicio = $data["fecha_inicio"];
        $this->fecha_fin  = $data["fecha_fin"];
    }

}