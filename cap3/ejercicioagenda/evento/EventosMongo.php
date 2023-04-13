<?php
require_once(dirname(__FILE__)."/../evento/Evento.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
require_once(dirname(__FILE__)."/../conexion/BDMongo.php");
require_once(dirname(__FILE__)."/../PersistentInterface.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

class EventosMongo extends Evento implements PersistentInterface, MongoDB\BSON\Persistable{

    function guardar(){


        if (!isset($this->id_evento)) {
            unset($this->id_evento); // = new MongoDB\BSON\ObjectID("");
            $res = BDMongo::getConexion()->eventos->insertOne($this);
            $this->id_evento =  $res->getInsertedId();
            
        } else {
            BDMongo::getConexion()->eventos->updateOne(
                [ "_id" => new MongoDB\BSON\ObjectID($this->id_evento) ],
                [ '$set' =>  $this]);
        }
    //    $stm = BDMongo::getConexion()->usuario->insertOne($this);
                
    }

    static function listar(){
        $eventos = [];
        $stm = BDMongo::getConexion()->eventos->find();
        $stm->setTypeMap(['root' => self::class]);
        foreach($stm as $event) {
              $eventos[(String)$event->getId_evento()] = $event;
        }
        return $eventos;
    }

    function modificar(){
        //echo ((String)$this->getFecha_fin()->format('Y-m-d H:i:s'));
        $update = BDMongo::getConexion()->eventos->updateOne(
            [ '_id' => new MongoDB\BSON\ObjectId($this->id_evento)],
                [ '$set' => [
                    'nombre' => $this->nombre,
                    'fecha_inicio' => (String)$this->getFecha_inicio()->format('Y-m-d H:i:s'),
                    'fecha_fin' => (String)$this->getFecha_fin()->format('Y-m-d H:i:s')
                ]]
        );
        
    }

    static function eliminar($id){
        BDMongo::getConexion()->eventos->deleteOne(
            [ "_id" => new MongoDB\BSON\ObjectID($id) ]
           );
    }


    public function bsonUnserialize(array  $data): void
    {
     //$this->nombre = $data["nombre"];
       foreach ($data as $key => $value) {
           switch ($key) {
               case '_id': $this->id_evento = (String)$value; break;
               case 'fecha_inicio': $this->fecha_inicio = new DateTime($value); break;
               case 'fecha_fin':  $this->fecha_fin = new DateTime($value); break;
               default: $this->$key = $value; break;
           }
       }
    }
    
    public function bsonSerialize(): array
    {
        $array = (array) $this;
        $array["fecha_inicio"]  = (String)$this->getFecha_inicio()->format('Y-m-d H:i:s');
        $array["fecha_fin"]  = (String)$this->getFecha_fin()->format('Y-m-d H:i:s');
        if (isset( $this->id_evento)) {
         $array['_id'] =  new MongoDB\BSON\ObjectID($this->id_evento);
        }
        unset($array['id_evento']);
        return $array;
    }

}