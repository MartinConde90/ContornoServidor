<?php

interface PersistentInterface{
    

    function guardar();

    static function listar();

    function modificar();

    static function eliminar($id);

    //function getObbjeto($id);
}