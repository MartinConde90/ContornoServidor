<?php
$array1 = array(
    "Viernes" => 22,
    "Sábado"  => 34
);

/*no modifica el array*/
foreach ($array1 as $cantidad){
    $cantidad = $cantidad * 2;
}
print_r($array1);
echo "<br>";

/*modifica el array*/
foreach ($array1 as &$cantidad){
    $cantidad = $cantidad * 2;
}
print_r($array1);
echo "<br>";