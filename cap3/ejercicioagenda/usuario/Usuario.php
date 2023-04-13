<?php

abstract class Usuario{

    public function __construct(
        public $nombre=null,
        public $correo=null,
        public $password=null,
        public $rol=0,
        public $encriptar=false,
        public $id_usuario=null
        )
    {
        if($encriptar){
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }

        public function comprobarValidarUsuario($correo,$contraseña){
            return $correo == $this->correo && password_verify($contraseña, $this->password);
        }

        public function getId_usuario()
        {
            return $this->id_usuario;
        }

        public function setId_usuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
            return $this;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
            return $this;
        }

        public function getCorreo()
        {
            return $this->correo;
        }

        public function setCorreo($correo)
        {
            $this->correo = $correo;
            return $this;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
            return $this;
        }

        public function getRol()
        {
            return $this->rol;
        }

        public function setRol($rol)
        {
            $this->rol = $rol;
            return $this;
        }

        
}