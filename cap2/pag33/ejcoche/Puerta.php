<?php
require_once("Ventana.php");

class Puerta{
    private $estado;
    private $ventana;

        function __construct($abierta=false)
        {
            $this->estado = $abierta;
            $this->ventana = new Ventana();
        }
        function abrir(){
            $this->estado=true;
        }

        function cerrar(){
            $this->estado=true;
        }

        function getVentana(){
            return $this->ventana;
        }
}