<?php
$directorio = dirname(__FILE__); //esto le dice al interprete en que carpeta estamos y desde donde tiene que buscar los archivos, ya que si no, empieza desde "contornoservidor"

$fich = fopen($directorio."/datos.csv","r");

if ($fich === FALSE){
    echo "No se encuentra el fichero datos.csv";
}else{
    while (!feof($fich)){
        $usuario = fscanf($fich,"%s %s %s %s %s");
        echo "<pre>";
        print_r($usuario);
        echo "</pre>";
    }
}
fclose($fich);
?>