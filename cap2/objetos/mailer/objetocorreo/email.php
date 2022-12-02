<?php

class Email{
    private $emisor;
    private $asunto;
    private $mensaje;

    function __construct()
    {
    }

    function datosEmail($emisor, $asunto, $mensaje){
        $this->emisor = $emisor;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    public function getEmisor()
    {
        return $this->emisor;
    }

    public function getAsunto()
    {
        return $this->asunto;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }
}