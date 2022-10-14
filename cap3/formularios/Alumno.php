<?php

class Alumno{
    private $nombre;
    private $apellidos;
    private $NIF;
    private $sexo;

    function __construct($nombre,$apellidos,$NIF,$sexo){
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->NIF = $NIF;
        $this->sexo = $sexo;   
    }

    function __toString(){
        return "Nombre: ". $this->nombre ."<br>". " Apellidos: ". $this->apellidos ."<br>". " NIF: ". $this->NIF ."<br>"." Sexo: ". $this->sexo;
    }
}