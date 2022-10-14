<?php
require_once("Rectangulo.php");

$prueba = new Rectangulo(3,4);
echo $prueba;
echo "\n";
$prueba->CalcularArea();
echo "\n";
$prueba->Mover(-3,-2);
echo $prueba;