<?php

class Persona{
    private $dni;
    private $nombre;
    private $apellido;

    function __construct($dni,$nombre,$apellido){
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function __toString(){
        return "Persona: ".$this->dni." - ".$this->nombre. " ".$this->apellido;
    }
}
/*
$persona = new Persona("12354123K","Chancas","Archivito");
echo $persona;
*/
//--------------------------------------------------------
class Persona8{
    function __construct(
        private $dni,
        private $nombre,
        private $apellido){
    }

    public function __toString(){
        return "Persona: ".$this->dni." - ".$this->nombre. " ".$this->apellido;
    }
}
/*
$persona = new Persona8("12354123K","Chanquiñas","Archivito");
echo $persona;
*/