<?php
$fichero = file_get_contents("datos.csv");
echo "<pre>".$fichero."</pre>";
file_put_contents("datos2.txt","Hola mundo2\n".$fichero); //para crear otro fichero con esos datos

?>