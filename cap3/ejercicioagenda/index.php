<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("location:login.php");
    exit();
} else {
    include("eventos.php");
}
?>