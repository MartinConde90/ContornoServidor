<?php

$palabra1 = "arenera";

function palindromo($p1){
    $palabra2= "";

    for($i=(strlen($p1)-1); $i>=0; $i--){
        $palabra2 .= $p1[$i];
    }
    return $palabra2;
}


if($palabra1 == palindromo($palabra1)){
    echo "La palabra ". $palabra1. " es un palindromo";
}
else{
    echo "La palabra ". $palabra1. " no es un palindromo";
}