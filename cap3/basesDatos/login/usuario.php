<?php
class Usuario {

    private $idUsuario;
    private $nombre;
    private $apellidos;
    private $correo;
    private $password;

    public function __construct($idUsuario,$nombre,$apellidos,$correo,$password)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->password = $password;
    }

    public function comprobarValidarUsuario($contraseña,$correo) {

        return password_verify($contraseña,$this->password) && $this->correo == $correo;
        
    }
    

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
 
    public function getCorreo()
    {
        return $this->correo;
    }
}