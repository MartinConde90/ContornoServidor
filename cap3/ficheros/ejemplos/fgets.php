<?php
$fich = fopen("../datos.csv","r+");

if ($fich === FALSE){
    echo "No se encuentra el fichero datos.csv";
}else{
    while (!feof($fich)){
        echo "<p>".fgets($fich)."</p>";
    }
    fputs($fich,"\n4 Marcos Fernandez Marcos@empresa.com 12345"); //mete esos datos
}
fclose($fich);
?>