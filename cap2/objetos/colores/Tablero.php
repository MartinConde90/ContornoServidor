<?php
require_once("./Fila.php");

class Tablero{
    private $colores = ["red", "blue","green","yellow", "purple", "orange"];
    private $filaGanadora;
    private $filaGanadoraActual;
    private $filaColoresPresentes = [];
    public $contador = 0;
    private $numIntentos;
    private $partidaGanada = false;
    
    function __construct(){

    }

    function rellenarUltimaFila(Fila $fila){
        return $fila->getColores();
        $this->numIntentos++;
    }

    function rellenarFilaSolución(Fila $fila){
        while($this->contador < count($fila->getColores())){
            //Código que comprueba si un color introducido existe en la solucion
            if(in_array($fila->getColores()[$this->contador],$this->filaGanadora)){
                if($this->filaColoresPresentes != null){
                    if (!in_array($fila->getColores()[$this->contador], $this->filaColoresPresentes)) {
                        array_push($this->filaColoresPresentes, $fila->getColores()[$this->contador]);
                    }
                }

                else{
                    $this->filaColoresPresentes[] = $fila->getColores()[$this->contador];
                    //array_push($this->filaColoresPresentes, $fila->getColores()[$this->contador]);
                   //Tratado como String:  $this->filaColoresPresentes = $fila->getColores()[$this->contador];
                }
                
             }
            if($fila->getColores()[$this->contador] == $this->filaGanadora[$this->contador]){
                $this->filaGanadoraActual[$this->contador] = $this->filaGanadora[$this->contador];
            }
            else{
                if(!isset($this->filaGanadoraActual[$this->contador])){
                    $this->filaGanadoraActual[$this->contador] = "";
                }
                else{

                }
            }
            $this->contador++;
        }
        $this->contador = 0;
        
    }

    function generarFilaGanadora(){
        shuffle($this->colores);
        $this->filaGanadora = array_slice($this->colores, 0, 4);

    }



    function comprobarGanar(){
        $this->partidaGanada = true;
        while($this->contador < count($this->filaGanadora) && $this->partidaGanada){
            if(isset($this->filaGanadoraActual[$this->contador])){
                if($this->filaGanadoraActual[$this->contador] != $this->filaGanadora[$this->contador]){
                    $this->partidaGanada = false;
                }
            }
            else{
                $this->partidaGanada = false;
            }
            $this->contador++;
        }
        $this->contador = 0;
        return $this->partidaGanada;
    }

    function getFilaGanadoraActual(){
        return $this->filaGanadoraActual;
    }

    function getFilaGanadora(){
        return $this->filaGanadora;
    }

    function getPartidaGanada(){
        return $this->partidaGanada;
    }

    function getNumeroIntentos(){
        return $this->numIntentos;
    }

    function getFilaColoresPresentes(){
        return $this->filaColoresPresentes;
    }

    function setFilaColoresPresentes($fila){
        $this->filaColoresPresentes = $fila;
    }

    function setFilaGanadora($fila){
        $this->filaGanadora = $fila;
    }
    
    function setFilaGanadoraActual($fila2){
        $this->filaGanadoraActual = $fila2;
    }

    function setNumIntentos($dato){
        $this->numIntentos = ++$dato;
    }

    function setPartidaGanada(){
        $this->partidaGanada = false;
    }
}

/* Código tabla ganadora 
<table class="tabla">
                <tr>
                    <?php
                    if (isset($controlador1)) {
                        foreach ($controlador1->getTablero()->getFilaGanadora() as $clave => $valor) {
                    ?>
                            <td style="background-color:<?php echo $valor; ?>"></td>
                        <?php
                        }
                    } else { ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php
                    }
                    ?>
                </tr>
            </table> */
?>