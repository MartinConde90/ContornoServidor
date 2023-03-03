<?php
require_once("PersistentInterface.php");
require_once("Usuario.php");
require_once("BDMySql.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class UsuarioMysql implements PersistentInterface{

    function guardar($datos){
        
        $stm = BDMySql::getConexion()->prepare("INSERT into usuario (nombre, email, pass, rol) values(:nombre,:email,:pass,:rol)"); 
                $stm->execute([":nombre"=>$datos->getNombre(),":email"=>$datos->getCorreo(),":pass"=>$datos->getPassword(),":rol"=>$datos->getRol()]);
    }

    function listar(){
        $stm = BDMySql::getConexion()->prepare("SELECT * from usuario"); //los dos puntos hacen referencia al nombre de la siguiente linea
        $stm->execute();
        $usuarios = [];
        while (($user = $stm->fetch())!=null) {
            $usuarios[] =  new Usuario($user["nombre"],$user["email"],$user["pass"],$user["rol"],false,$user["idusuario"]);
        }
        return $usuarios;
    }

    function modificar($datos){
        $stm = BDMySql::getConexion()->prepare("UPDATE usuario SET nombre = :nombre , email = :email, rol = :rol where idusuario=:id");
        $stm->execute([":nombre"=>$datos->getNombre(),":email"=>$datos->getCorreo(),":rol"=>$datos->getRol(),":id"=>$datos->getId_usuario()]);
    }

    function eliminar($id){
        $stm = BDMySql::getConexion()->prepare("DELETE from usuario where idusuario = :id "); //los dos puntos hacen referencia al nombre de la siguiente linea
        $stm->execute([":id"=>$id]);
    }

}