<?php

/* rwx
   101 eso es 5

   si desplazamos 2 bits a la izquierda, nos quedamos con el primer 1, asi sabemos si tiene permiso de lectura
*/
$permiso = 5;

if($permiso >> 2){
    echo "Tiene permiso de lectura\n";
}else{
    echo "No tiene permiso de lectura\n";
}



/*
101 -> 5
010 -> 2
----
000 -> falso porque el resultado no es igual a 010, osea, lectura
*/
if(($permiso&2) == 2){
    echo "Tiene permiso de escritura\n";
}else{
    echo "No tiene permiso de escritura\n";
}