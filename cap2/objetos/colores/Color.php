<?php
class Color{
    // @param id -> define el color del 
    private $colorNombre;

    function __construct($colorNombre){
                $this->setNombreColor($colorNombre);
    }

    function getColorNombre(){

        return $this->colorNombre;
    }

    function compararColores($color){
        if($color->colorNombre == $this->colorNombre){
            echo "Los id de los colores son : " . $color->getColorNombre() . "y " . $this->getColorNombre();
            $this->setAcertado();
            return true;
        }
        else{
            echo("Los colores no son iguales");
            return false;
        }
    }


    function setNombreColor($colorNombre){
        $this->colorNombre = $colorNombre;
    }
    
    function setAcertado(){
        $this->acertado = true;
    }
}

?>