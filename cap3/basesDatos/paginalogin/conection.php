<?php
$conn = "mysql:dbname=docker_demo;host=docker-mysql";
$usuario = "root";
$passw = "root123";


try{
    $bd = new PDO($conn, $usuario, $passw);
    $mail = $_POST["email"];
    $pass = $_POST["pass"];

    $sql =  "SELECT * FROM usuario WHERE email= '$mail' AND pass= '$pass'";
    $datos = $bd->query($sql);
    
}catch(Exception $e){
    echo "ERROR:".$e->getMessage();
 }