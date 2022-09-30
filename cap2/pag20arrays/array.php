<?php

$mi_array = [0=>"Hola",
             1=>"Adios"]; //los arrays tienen clave -> valor
for($i=0; $i<count($mi_array);$i++){
    echo "Elemento $i valor: " . $mi_array[$i] . "\n";
}

$array = ["Holiwi","Adios"]; //esto es una lista, no un array
for($i=0; $i<count($array);$i++){
    echo "Elemento $i  tiene el valor: " . $array[$i] . "\n";
}

$datos = ["nombre"=>"juan",
          "apellido"=>"perez",
          "ciudad"=>"ourense"];

foreach($datos as $key => $valor){
    echo "$key:$valor\n";
}