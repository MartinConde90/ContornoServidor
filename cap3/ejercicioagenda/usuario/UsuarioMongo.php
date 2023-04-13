<?php
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
require_once(dirname(__FILE__)."/../conexion/BDMongo.php");
require_once(dirname(__FILE__)."/../usuario/Usuario.php");
require_once(dirname(__FILE__)."/../vendor/autoload.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class UsuarioMongo extends Usuario implements PersistentInterface, MongoDB\BSON\Persistable {
    function guardar(){


        if (!isset($this->id_usuario)) {
            unset($this->id_usuario); // = new MongoDB\BSON\ObjectID("");
            $res = BDMongo::getConexion()->usuario->insertOne($this);
            $this->id_usuario =  $res->getInsertedId();
        } else {
            BDMongo::getConexion()->usuario->updateOne(
                [ "_id" => new MongoDB\BSON\ObjectID($this->id_usuario) ],
                [ '$set' =>  $this]);
        }
    //    $stm = BDMongo::getConexion()->usuario->insertOne($this);
                
    }

    static function listar(){
        $usuarios = [];
        $stm = BDMongo::getConexion()->usuario->find();
        $stm->setTypeMap(['root' => self::class]);
        foreach($stm as $user) {
              $usuarios[(String)$user->getId_usuario()] = $user;
        }
        return $usuarios;
    }

    function modificar(){

        $update = BDMongo::getConexion()->usuario->updateOne(
            [ '_id' => new MongoDB\BSON\ObjectId($this->id_usuario)],
                [ '$set' => [
                    'nombre' => $this->nombre,
                    'correo' => $this->correo,
                    'pass' => $this->password,
                    'rol' => $this->rol,
                    'id_usuario' => $this->id_usuario
                ]]
        );
        
    }

    static function eliminar($id){
        BDMongo::getConexion()->usuario->deleteOne(
            [ "_id" => new MongoDB\BSON\ObjectID($id) ]
           );
    }


    public function bsonUnserialize(array  $data): void
    {
     //$this->nombre = $data["nombre"];
       foreach ($data as $key => $value) {
           switch ($key) {
               case '_id': $this->id_usuario = (String)$value; break;
               default: $this->$key = $value; break;
           }
       }
    }
    
    public function bsonSerialize(): array
    {
        $array = (array) $this;
        if (isset( $this->id_usuario)) {
         $array['_id'] =  new MongoDB\BSON\ObjectID($this->id_usuario);
        }
        unset($array['id_usuario']);
        return $array;
    }
    

}