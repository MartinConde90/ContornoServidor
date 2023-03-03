<?php
/*$conn = "mysql:dbname=docker_demo;host=docker-mysql";
$usuario = "root";
$passw = "root123";
$bd = new PDO($conn, $usuario, $passw);
*/
//echo phpinfo();

class BDMySql{
    private $conexion;
    private static $bd;

    private function __construct(){
        $conn = "mysql:dbname=docker_demo;host=docker-mysql";
        $usuario = "root";
        $passw = "root123";
        $this->conexion = new PDO($conn, $usuario, $passw);
    }

    private function __clone() { }

    public static function getConexion(){

        if (!isset(self::$bd)) {
            self::$bd = new BDMySql();
        }

        return self::$bd->conexion;
    }
}