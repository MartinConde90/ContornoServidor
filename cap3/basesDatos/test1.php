<?php

$conn = "mysql:dbname=docker_demo;host=docker-mysql";
$usuario = "root";
$passw = "root123";


try{
    $bd = new PDO($conn, $usuario, $passw);
    $sql =  "select * from usuario";
    $datos = $bd->query($sql);
    echo "Total usuarios: ". $datos->rowCount()."<br>";
    foreach($datos as $usu){
        echo $usu["nombre"].", ";
        echo $usu["apellidos"]."<br>";
    }
    echo "------------------<br>";
    $stm = $bd->prepare("SELECT * FROM usuario WHERE idusuario <= ?");
    $datos = $stm->execute([3]);
    foreach($stm as $d){
        echo $d["nombre"].", ";
        echo $d["apellidos"]."<br>";
    }

}catch(Exception $e){
    echo "ERROR:".$e->getMessage();
 }