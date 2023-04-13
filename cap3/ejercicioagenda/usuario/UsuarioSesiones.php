<?php
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
require_once(dirname(__FILE__)."/../usuario/Usuario.php");
require_once(dirname(__FILE__)."/../PersistentInterface.php");
require_once(dirname(__FILE__)."/../PersistentInterface.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class UsuarioSesiones extends Usuario implements PersistentInterface{

    function guardar(){
        $usuarios =[];
        if(isset($_SESSION['usuarios'])){
            $usuarios = unserialize($_SESSION['usuarios']);
        }
        $this->setRol(1);
        if(empty($usuarios)){
            $this->setId_usuario(1);
           }else{
                $ids=[];
                for($i=1; $i<=count($usuarios); $i++){
                    array_push($ids,$usuarios[$i]->getId_usuario());
                }
                $this->setId_usuario(max($ids)+1);
           }

        $usuarios[$this->getId_usuario()] = $this;
        $_SESSION['usuarios'] =  serialize($usuarios);
    }

    static function listar(){
        $usuarios = [];
        if(isset($_SESSION['usuarios'])){
            $usuarios = unserialize($_SESSION['usuarios']);
        }
        return $usuarios;
    }

    function modificar(){
        $usuarios =[];
        $usuarios = unserialize($_SESSION['usuarios']);
        $usuarios[$this->getId_usuario()] = $this;
        $_SESSION['usuarios'] =  serialize($usuarios);
    }

    static function eliminar($id){
        $usuarios = [];
        if(isset($_SESSION['usuarios'])){
            $usuarios = unserialize($_SESSION['usuarios']);
        }
        unset($usuarios[$id]);
        $_SESSION['usuarios'] =  serialize($usuarios);

    }

}