<?php

class Dni{
    private $numero;
    private $letra;
    private $arr;

    function __construct($num=0,$cadena=" "){
        $this->numero = $num;
        $this->letra = $cadena;
        $this->arr = [
            0 => "T" , 1 => "R", 2 => "W", 3 => "A", 4 => "G", 5 => "M" , 6=> "Y",

            7 => "F" , 8 => "P", 9 => "D",10 => "X",11 => "B",12 => "N" ,13=>"J",
           
           14 => "Z" , 15=> "S", 16 =>"Q",17 => "V",18 => "H",19 => "L" ,20=> "C", 21 => "K", 22=> "E"
        ];
    }
    

        public function getNum()
        {
                return $this->num;
        }

        public function setNum()
        {
                $this->num = $this->calcular();
                return $this;
        }

        public function getCadena()
        {
                return $this->cadena;
        }

        public function setCadena($cadena)
        {
                $this->cadena = $cadena;

                return $this;
        }

        public function calcular(){
            $div = $this->numero%23;
            $this->letra = $this->arr[$div];    
        }

        public function leer(){
            $cifra= readline('Introduce cifra Dni: ');
            $this->numero = $cifra;
            $this->calcular($cifra);
        
        }

        public function mostrar(){
            echo "Dni: " . $this->numero." - ".$this->letra;
        }

        public function __toString(){
            return "Titular: ".$this->numero." - ".$this->letra;
        }
}

$prueba = new Dni(44477418);
$prueba->calcular();
echo $prueba;

echo "\n";

$prueba = new Dni(44662476);
$prueba->setNum();
$prueba->mostrar();