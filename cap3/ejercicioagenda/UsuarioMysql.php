<?php
require_once("PersistentInterface.php");
require_once("Usuario.php");
require_once("BDMySql.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class UsuarioMysql extends Usuario implements PersistentInterface{

    function guardar(){
        
        $stm = BDMySql::getConexion()->prepare("INSERT into usuario (nombre, email, pass, rol) values(:nombre,:email,:pass,:rol)"); 
                $stm->execute([":nombre"=>$this->getNombre(),":email"=>$this->getCorreo(),":pass"=>$this->getPassword(),":rol"=>$this->getRol()]);
                
    }

    static function listar(){
        $stm = BDMySql::getConexion()->prepare("SELECT * from usuario"); //los dos puntos hacen referencia al nombre de la siguiente linea
        $stm->execute();
        $usuarios = [];
        while (($user = $stm->fetch())!=null) {
            $usuarios[$user["idusuario"]] =  new UsuarioMysql($user["nombre"],$user["email"],$user["pass"],$user["rol"],false,$user["idusuario"]);
        }
        return $usuarios;
    }

    function modificar(){
        $stm = BDMySql::getConexion()->prepare("UPDATE usuario SET nombre = :nombre , email = :email, rol = :rol where idusuario=:id");
        $stm->execute([":nombre"=>$this->getNombre(),":email"=>$this->getCorreo(),":rol"=>$this->getRol(),":id"=>$this->getId_usuario()]);
    }

    static function eliminar($id){
        $stm = BDMySql::getConexion()->prepare("DELETE from usuario where idusuario = :id "); //los dos puntos hacen referencia al nombre de la siguiente linea
        $stm->execute([":id"=>$id]);
    }

}