<?php
require_once(dirname(__FILE__)."/../usuario/Usuario.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); 
} 

$id = $_GET['id'];

if ($_SESSION["id"] == $id) {
    
    echo '<div class="tenor-gif-embed" data-postid="9628120" data-share-method="host" data-aspect-ratio="1.55" data-width="100%"><a href="https://tenor.com/view/jurassic-park-ah-you-didnt-say-the-magic-word-say-please-gif-9628120">Jurassic Park Ah GIF</a>from <a href="https://tenor.com/search/jurassic+park-gifs">Jurassic Park GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>';
    echo '<audio src="palabra.mp3" autoplay loop></audio>'; 
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){';
    echo 'alert("No puedes eliminarte a ti mismo");';
    echo 'window.location.href = "../mostrarDatos/listarUsuarios.php";';
    echo '}, 3000);';
    echo '</script>';
      
} else {
    $usuarios = SelectorPersistente::getUsuarioPersistenteClass()::listar();

    foreach ($usuarios as $key => $usuario) {
        if ($usuario->getId_usuario() == $id) {
            SelectorPersistente::getUsuarioPersistenteClass()::eliminar($id);
        }
    }

    header("location:../mostrarDatos/listarUsuarios.php");
    exit();
}