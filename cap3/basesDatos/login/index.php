<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location:login.php");
    exit();
} else {
    include("tablaUsuarios.php");
    //header("location:privado.php");
    //exit();
}
?>