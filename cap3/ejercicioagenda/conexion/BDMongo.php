<?php
require_once(dirname(__FILE__)."/../vendor/autoload.php");

class BDMongo{
    private  $conexion;
    private static $bd;

    private function __construct(){
        $conn = new MongoDB\Client("mongodb://root:example@mongo:27017");
        $this->conexion = $conn->agenda;
    }

    private function __clone() { }

    public static function getConexion(){

        if (!isset(self::$bd)) {
            self::$bd = new BDMongo();
        }

        return self::$bd->conexion;
    }
}