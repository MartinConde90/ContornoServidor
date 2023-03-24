<?php
if(!session_start()){
    session_start();
}
if (!isset($_SESSION["correo"])) {
    header("location:login.php");
    exit();
} else {
    header("location:agenda.php");
}
?>