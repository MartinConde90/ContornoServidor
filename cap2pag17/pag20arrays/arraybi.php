<?php

$array1 = array(0,3,6,5,[87,34,65],"hola","adios");

//

foreach($array1 as $key => $valor){
    if(is_array($valor)){
        foreach($valor as $k => $v)
        print_r("$v\n");
    }
    else{
    print_r($valor . "\n");
    }
}