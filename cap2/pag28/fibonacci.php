<?php

function fibo1($n){
    if ($n <2 ) return $n;
    if ($n > 1) return fibo1($n-1) + fibo1($n-2);
}

echo fibo1(10);



function fibo2($num){
    $resultados = [0,1];
    for($i=2;$i<=$num;$i++){
        $resultados[$i] = $resultados[($i-1)]+$resultados[($i-2)];
    }
    return $resultados[$num];
}
echo fibo2(8);
