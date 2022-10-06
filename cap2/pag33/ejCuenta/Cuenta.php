<?php

class Cuenta{
    private $titular;
    private $cantidad;

    function __construct($titular,$cantidad=100){
        $this->titular = $titular;
        $this->cantidad = $cantidad;
    }
        
        public function getTitular()
        {
                return $this->titular;
        }

        public function getCantidad()
        {
                return $this->cantidad;
        }

        public function setTitular($titular)
        {
                $this->titular = $titular;

                return $this;
        }

        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

                return $this;
        }

        public function ingresar($cash){
            if($cash>0){
                $this->cantidad +=$cash;
            }

        }

        public function retirar($cash){
            if($this->cantidad-$cash>=0){
                $this->cantidad -=$cash;
            }
            else{
                $this->cantidad = 0;
            }

        }

        public function __toString(){
            return "Titular: ".$this->titular." - Cantidad ".$this->cantidad;
        }
}

$prueba = new Cuenta("Paco",150);

echo $prueba->getCantidad()."\n";

$prueba->retirar(100);

echo $prueba->getCantidad()."\n";

$prueba->retirar(100);

echo $prueba->getCantidad();