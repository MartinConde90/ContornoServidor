<?php
session_start();
if(isset($_SESSION["correo"])){
    $id = $_GET['id'];
    $dsn = "mysql:dbname=docker_demo;host=docker-mysql";
        $usuario ="root";
        $password = "root123";
        $bd = new PDO($dsn, $usuario, $password);
        //$sql = "select * from usuario where correo='$correo' and password='$passwd' limit 1";
        //echo $sql;
        //$datos = $bd->query($sql); //JAMAS NO USAR

        $stm = $bd->prepare("DELETE from usuario where idusuario = :id "); //los dos puntos hacen referencia al nombre de la siguiente linea
        $stm->execute([":id"=>$id]);
        include("tablaUsuarios.php");
}

