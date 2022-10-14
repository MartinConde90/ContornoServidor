<?php
require_once("Coche.php");

$coche = new Coche(50);

print_r($coche);

$coche->getPuerta(0)->abrir();
$coche->getRueda(2)->inflar();
$coche->getPuerta(0)->getVentana(0)->abrir();
print_r($coche->getPuerta(0));
print_r($coche->getRueda(2));
print_r($coche->getPuerta(0)->getVentana(0));