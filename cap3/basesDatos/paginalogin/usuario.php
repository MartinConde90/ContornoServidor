<?php

class Usuario{
    private $nombre;
    private $email;
    private $contraseña;

    function __construct($nombre, $email, $contraseña)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contraseña = $contraseña;
    }

    
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    function mostrar()
    {
        echo $this->getNombre() . '<br>' . $this->getEmail();
    }
    
}