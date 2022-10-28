<?php

class Nif{
    private $nif;
    private $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

    function __construct($doc)
    {
        $this->nif= $doc;
    }

    public function comprobar(){
        $numero = substr($this->nif, 0 , -1);
        $letra = substr($this->nif, -1);
        $char = $numero%23;
        if($letra == $this->letras[$char]){
            return true;
        }
        else{
            return false;
        }
    }
}
