<?php

class Datos{
    public function __construct(public $nombre, public $apellidos)
    {
        
    }
}


$datos = [["nombre"=>"Luis","apellidos"=>"Conde Rua"],["nombre"=>"Martin","apellidos"=>"Conde Grande"],["nombre"=>"Diego","apellidos"=>"Conde Grande"]];
echo $json = json_encode($datos);
echo "\n"."--------------------------------------------------";
var_dump(json_decode($json));

echo "--------------------------------------------------"."\n";
echo $json = json_encode(new Datos("Brandon","Conde"));
echo "--------------------------------------------------"."\n";
var_dump(json_decode($json));