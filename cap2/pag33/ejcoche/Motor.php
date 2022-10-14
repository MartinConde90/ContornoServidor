<?php

class Motor{
    private $estado;

        function __construct($encendido=false)
        {
            $this->estado = $encendido;
        }
        function arrancar(){
            $this->motor = true;   
        }

        function apagar(){
            $this->motor = false;
        }
}
