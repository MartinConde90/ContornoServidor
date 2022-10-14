<?php

class Rectangulo{
    private $x1;
    private $y1;
    private $x2;
    private $y2;

    function __construct($x2,$y2,$x1=0,$y1=0){
            $this->x1 = $x1;
            $this->y1 = $y1;
            $this->x2 = $x2;
            $this->y2 = $y2;
        
    }
        public function CalcularArea(){
            $base = $this->x2 - $this->x1;
            $altura = $this->y2 - $this->y1;

            echo "El área del rectángulo es: ".$base*$altura;
        }

        public function Mover($movX,$movY){
            $this->x1 += $movX;
            $this->y1 += $movY;
            $this->x2 += $movX;
            $this->y2 += $movY;

            echo "Desplazamos el eje de la X en: ".$movX."\n".
                 "Desplazamos el eje de la Y en: ".$movY."\n";
        }

        public function __toString(){
            return ("Vértices: "."\n"."(".$this->x1.",".$this->y2.")(".$this->x2.",".$this->y2.")"."\n"."(".$this->x1.",".$this->y1.")(".$this->x2.",".$this->y1.")"
                    );
        }
}