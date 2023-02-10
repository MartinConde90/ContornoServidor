<?php

class Evento{

    public function __construct(
        private $id_evento=null,
        private $nombre=null,
        private ?DateTime $fecha_inicio=null,
        private ?DateTime $fecha_fin=null,
        private $id_usuario=null
    )
    {
        if($this->id_evento == null){
            throw new Exception("El evento necesita un usuario asignado");
        }
        if($this->fecha_fin==null){
            $this->fecha_fin = clone $this->fecha_inicio;
            $this->fecha_fin->modify("+ 1 hour");
        }
    }

        public function getId_evento()
        {
            return $this->id_evento;
        }
 
        public function setId_evento($id_evento)
        {
            $this->id_evento = $id_evento;
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

        public function getFecha_inicio()
        {
            return $this->fecha_inicio;
        }

        public function setFecha_inicio($fecha_inicio)
        {
            $this->fecha_inicio = $fecha_inicio;
            return $this;
        }
 
        public function getFecha_fin()
        {
            return $this->fecha_fin;
        }

        public function setFecha_fin($fecha_fin)
        {
            $this->fecha_fin = $fecha_fin;
            return $this;
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

        function __serialize(): array
    {
        return [
        "id_evento"=>$this->id_evento,
        "id_usuario"=>$this->id_usuario,
        "nombre"=>$this->nombre,
        "fecha_inicio"=>$this->fecha_inicio,
        "fecha_fin"=>$this->fecha_fin  ];
    }

    function __unserialize(array $data): void
    {
        $this->id_evento = $data["id_evento"];
        $this->id_usuario = $data["id_usuario"];
        $this->nombre = $data["nombre"];
        $this->fecha_inicio = $data["fecha_inicio"];
        $this->fecha_fin  = $data["fecha_fin"];
    }
}