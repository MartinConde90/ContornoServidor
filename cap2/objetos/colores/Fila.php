<?php
require_once('./Color.php'); 
class Fila{
    private $colores = [];
    const NUM_COLORES = 4;
    
    function __construct(Color $color1, Color $color2, Color $color3, Color $color4 ){
        $this->setColor($color1);
        $this->setColor($color2);
        $this->setColor($color3);
        $this->setColor($color4);
    }

    function comparar($fila){

    }

    function setColor(Color $color){
        array_push($this->colores, $color->getColorNombre());
    }

    function getColores(){
        return $this->colores;
    }

    function __toString()
    {
        var_dump($this->colores);
    }
}

$color1 = new Color("Rojo");

?>