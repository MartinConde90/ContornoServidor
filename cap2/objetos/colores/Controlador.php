<?php
require_once('./Tablero.php');
session_start();
class Controlador
{
    private $tablero1;

    public function __construct()
    {

        
        $this->tablero1 = new Tablero();
        if(!isset($_SESSION["tablero"])) {
            $this->tablero1 = new Tablero();
            $this->tablero1->generarFilaGanadora();
        } else {
            $this->cargarEstado();
        }
        $this->tablero1->comprobarGanar();
        
    }

    public function tratarDatosEntrada($filaEntrada){
    $this->tablero1->rellenarFilaSolución($filaEntrada);
    }
    
    public function guardarEstado()
    {
        $datos["solucion"] = $this->tablero1->getFilaGanadora();
        $datos["solucionActual"] = $this->tablero1->getFilaGanadoraActual();
        $datos["numIntentos"] = $this->tablero1->getNumeroIntentos();
        $datos["coloresPresentes"] = $this->tablero1->getFilaColoresPresentes();
        $_SESSION["tablero"] = $datos;
        
    }

    public function cargarEstado(){
        $datos =  $_SESSION["tablero"];
        $this->tablero1->setFilaGanadora($datos["solucion"]);
        $this->tablero1->setFilaGanadoraActual($datos["solucionActual"]);
        $this->tablero1->setNumIntentos($datos["numIntentos"]);
        $this->tablero1->setFilaColoresPresentes(($datos["coloresPresentes"]));
    }

    function getTablero()
    {
        return $this->tablero1;
    }
}
