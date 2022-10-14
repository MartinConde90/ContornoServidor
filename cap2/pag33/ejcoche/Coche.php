<?php
require_once ("Motor.php");
require_once ("Rueda.php");
require_once ("Puerta.php");

class Coche{
    private $motor;
    private $ruedas;
    private $puertas;
    private $estadoDeposito;

        function __construct($estadoDeposito){
            $this->estadoDeposito = $estadoDeposito;

            $this->motor = new Motor();

            for($i=0; $i<4; $i++){
                $this->ruedas[]=new Rueda();
            }
            for($i=0; $i<2; $i++){
                $this->puertas[]=new Puerta();
            }
        }
        
        function getMotor(){
            return $this->motor;
        }
        function getRueda($id_rueda){
            return $this->ruedas[$id_rueda];
        }
        function getPuerta($id_puerta){
            return $this->puertas[$id_puerta];
        }
        function llenar($litros){
            $this->estadoDeposito +=$litros;
        }
        function getEstadoDeposito(){
            return $this->estadoDeposito;
        }
}
