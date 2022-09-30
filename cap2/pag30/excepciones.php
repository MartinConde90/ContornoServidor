<?php

//A - try catch fuera de la funcion
function neg1($num){
    if($num<0){
        throw new Exception("Numero negativo");
    }
    return $num;
}

try{
    $r1 = neg1(-1);
}
catch(Exception $e){
    echo "Excepcion: " . $e->getMessage(); //En la $e metemos el mensaje del objeto Exception que creamos arriba en la linea 6
}


//B - try catch dentro de la funcion
function neg2($num){
    try{
        if($num<0){
            throw new Exception("Numero negativo");
        }
        return $num;
    }catch(Exception $e){
        return "Error: " . $e->getMessage()."\n";
    }
}

echo neg2(-7);


    
