<?php

class Usuario{

    public function __construct(
        private $id_usuario=null,
        private $nombre=null,
        private $correo=null,
        private $password=null,
        private $rol=0,
        $encriptar=false)
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