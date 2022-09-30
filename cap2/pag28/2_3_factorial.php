<?php
function factorial($valor,&$sum){
    if($valor == is_int($valor) && $valor >=1){
        for($i=1; $i<=$valor; $i++){
            $sum += $i;
        }
        return $sum;
    }
    else{
        return -1;
    }
}
$numero = 3;
$suma=0;

$r1 = factorial($numero,$suma);
echo $r1;


//SOLUCION RECURSIVA
function factorialR($num){
    $resultado = -1;
    if($num==1){
        $resultado =1;
    }else{
        if($num>1){
            $resultado = $num*factorialR($num-1);
        }
    }
    return $resultado;
}

echo factorialR(5);