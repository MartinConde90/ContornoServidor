<?php
$falso = true && false;
echo $falso?'Cierto':'Falso';

echo "\n";

$deberiaSerFalso = true and false;
echo $deberiaSerFalso?'Cierto':'Falso';

echo "\n";

$cierto = false || true;
echo $cierto?'Cierto':'Falso';

echo "\n";

$deberiaSerCierto = false or true;
echo $deberiaSerCierto?'Cierto':'Falso';