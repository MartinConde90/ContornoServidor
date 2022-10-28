<?php
require_once("Nif.php");

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

<<<<<<< HEAD
    function getNif(){
=======
    function Nif(){
>>>>>>> afb7b6f3ec3a1f63b938c22e254932015e4e1452
        $prueba = new Nif($this->NIF);
        return $prueba->comprobar();  
    }

    function __toString(){
<<<<<<< HEAD
        if($this->getNif()){
=======
        if($this->Nif()){
>>>>>>> afb7b6f3ec3a1f63b938c22e254932015e4e1452
            return "Nombre: ". $this->nombre ."<br>". " Apellidos: ". $this->apellidos ."<br>". " NIF: ". $this->NIF ."<br>"." Sexo: ". $this->sexo;
        }
        else{
            return "NIF erroneo";
        }
        
    }
}