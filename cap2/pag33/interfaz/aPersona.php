<?php
require_once("iPersona.php");

abstract class aPersona implements iPersona{
    public function __toString(){
        return $this->getNombre()." ".$this->getApellido();
    }
    
}

class Persona extends aPersona{
    function __construct(
        private $nombre,
        private $apellido){
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
            return $this->nombre;
    }

    /**
     * Get the value of apellido
     */ 
    public function getApellido()
    {
            return $this->apellido;
    }


}
$person = new Persona("Chan","cas");
echo($person);