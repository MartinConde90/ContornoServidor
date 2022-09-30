<?php

$array1 = [10,20,['2',3,7,8],40];
foreach($array1 as $valor){
    if(is_array($valor)){
        foreach($valor as $v)
        echo($v ."\n");
    }
    else{
    echo($valor ."\n");
    }
}

?>