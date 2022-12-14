<?php



//Variables
//Crea la constante PALABRA con el array "suerte","GANAR","perder","aprobar"  (1 punto)

const PALABRAS = array("suerte","GANAR","perder","aprobar");

$palabra = "APROBAR";
$palabra_oculta = "_"; //Tantos guiones como letras tiene $palabra
$letras = [];  // Letras jugadas por el jugador en la partida actual
$vidas = 7; //Vidas de las que dispone el jugador para adivinar la $palabra
$mensaje = null;  //Mensajes a mostrar el jugador: letra repetida, ha gando, ha perdido, ...
$partidas_jugadas = 0;  //Partidas totales jugadas por el jugador
$partidas_ganadas = 0; //Partidas ganadas por el jugador

//Código que necesites incluir y no este definido --> (0,25 puntos)
session_start();
ini_set('display_errors','Off');
//-------
//Funciones necesarias para desarrollar el juego
/**
 * posiscionesLetra
 * Función que devuelve las posiciones de la "letra" enviada en la palabra a adivinar
 * (2 puntos)
 * @param  mixed $palabra palabra que se ha de acertar
 * @param  mixed $letra letra enviada por el jugador
 * @return mixed Devuelve "false" si no se encuentra la letra en la palabra,
 *               en otro caso devuelve un "array" con las posiciones de esta
 */

 function posicionesLetra($palabra,$letra){
    $posiciones = array();
    $contador = 0;

    for($i=0; $i<strlen($palabra); $i++){
        //$letrapos = substr($palabra, $i,1);
        if($palabra[$i] ==  strtoupper($letra)){
            $posiciones[] = $i;
            $contador++;
        }
    }

    if($contador == 0){
        return false;
    }
    else{
        return $posiciones;
    }
 }
 
//
/**
 * colocarletras
 *  Función que coloca la letra en sus posiciones en la palabra oculta
 *      ej:)    palabra a adivinar "SOL" letra= "O" palabra_oculta="___" return "_O_"
 * (1 punto)
 * @param  mixed $palabra_oculta  palabra que contiene guiones y que serán sustituidos en esta función
 * @param  mixed $posiciones posiciones donde se encuentra la letra en la palabra a adivinar
 * @param  mixed $letra letra a colocar en la palabra
 * @return string palabra oculta con la letra en sus posiciones  
 */

function colocarLetras($palabra_oculta, $posiciones, $letra){
    $palabranew = $palabra_oculta;
    if($posiciones!=false){
        for($i=0; $i<count($posiciones); $i++){
            //$palabranew = substr_replace($palabranew, $letra, $posiciones[$i], 1);
            $palabranew[$posiciones[$i]]= strtoupper($letra);
        } 
    }
    
    return $palabranew;
 }


/**
 * cargarestadojuego
 *  Carga los datos del juego necesarios de la anterior jugada
 * (1 punto)
 * @param  mixed $palabra palabra a adivinar por el jugador
 * @param  mixed $palabra_oculta palabra con la longitud de la $palabra que contiene _ en lugar de las letras
 * @param  mixed $letras letras jugadas por el jugador en la partida actual
 * @param  mixed $vidas vidas que le restan al jugador en la partida actual
 * @param  mixed $partidas_jugadas número de partidas jugadas por el jugador
 * @param  mixed $partidas_ganadas número de partidas ganadas por el jugador
 * @return void
 */

function cargarestadojuego(&$palabra, &$palabra_oculta, &$letras, &$vidas, &$partidas_jugadas, &$partidas_ganadas){
    $palabra = $_SESSION["palabra"];
    $palabra_oculta = $_SESSION["oculta"];
    $letras = $_SESSION["letras"];
    $vidas = $_SESSION["vidas"];
    $partidas_jugadas = $_COOKIE["contadorjugadas"];
    $partidas_ganadas = $_COOKIE["contadorganadas"];
}

/**
 * guardarestadojuego
 * 
 * Guarda el estado de la partida para que se pueda continuar el juego en la próxima llamada a la página
 * (0,5 puntos)
 * @param  mixed $palabra palabra a adivinar por el jugador
 * @param  mixed $palabra_oculta  palabra con la longitud de la $palabra que contiene _ en lugar de las letras
 * @param  mixed $letras letras jugadas por el jugador en la partida actual
 * @param  mixed $vidas vidas que le restan al jugador en la partida actual
 * @return void
 */

function guardarestadojuego($palabra,$palabra_oculta,$letras,$vidas){
    $_SESSION["palabra"] = $palabra;
    $_SESSION["oculta"] = $palabra_oculta;
    $_SESSION["letras"] = $letras;
    $_SESSION["vidas"] = $vidas;
}

/**
 * iniciarjuego
 * (1 punto)
 * obtiene la $palabra al azar del array PALABRAS
 * crea la palabra_oculta a partir de la palabra generada al azar
 * inicializa el array de $letras jugadas en la partida
 * inicializa el numero de $vidas a 7
 * 
 * En caso de ganar o perder una partida actualiza el número de partidas jugadas y ganadas
 * los parametros $ganar, $partidas_jugadas y $partidas_ganadas son opcionales, en caso de no ser
 * necesarios su valor por defecto será null
 *
 * @param  mixed $palabra palabra a adivinar por el jugador
 * @param  mixed $palabra_oculta palabra con la longitud de la $palabra que contiene _ en lugar de las letras
 * @param  mixed $letras letras jugadas por el jugador en la partida actual
 * @param  mixed $vidas vidas que le restan al jugador en la partida actual
 * @param  mixed $ganar [default null] Permite indicar si se ha ganado o perdio una partida (true, false)
 * @param  mixed $partidas_jugadas [default null] número de partidas jugadas por el jugador
 * @param  mixed $partidas_ganadas [default null] número de partidas ganadas por el jugador
 * @return void
 */

 
function iniciarjuego(&$palabra,&$palabra_oculta,&$letras,&$vidas,&$partidas_jugadas=null,&$partidas_ganadas=null,$ganar=false){
    
    $letras = 0;
    $vidas = 7;
    $_SESSION["ganar"] = $ganar;
    $palabra = strtoupper(PALABRAS[array_rand(PALABRAS)]);
    $palabra_oculta = "";
    $_SESSION["oculta"] = $palabra_oculta;

    for($i=0; $i<strlen($palabra); $i++){
        $_SESSION["oculta"] .= "_";
        
    }
    
    if(!isset($_COOKIE["contadorjugadas"]) && !isset($_COOKIE["contadorganadas"])){
        setcookie("contadorjugadas",$partidas_jugadas,time()+3600*24*360);
        setcookie("contadorganadas",$partidas_ganadas,time()+3600*24*360);
    }
}



//Control del juego (2,25 puntos)
/*
Utiliza aquí las funciones creadas anteriormente y haz que el juego funcione
*/

if(!isset($_SESSION["letras"])){
    $_SESSION["letras"] = array();
    $_SESSION["vidas"] = $vidas;

    iniciarjuego($palabra,$palabra_oculta,$letras,$vidas,$partidas_jugadas,$partidas_ganadas);
    $_SESSION["palabra"] = $palabra;
    $mensaje= "Salva al monigote";
}

cargarestadojuego($palabra, $palabra_oculta, $letras, $vidas, $partidas_jugadas, $partidas_ganadas);



if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["letra"]) && isset($_SESSION["letras"]) && $_SESSION["vidas"]>0 && $_SESSION["palabra"]!=$_SESSION["oculta"]){
    
    array_push($_SESSION["letras"],strtoupper($_POST["letra"]));


    $palabra = $_SESSION["palabra"];
    $palabra_oculta = $_SESSION["oculta"];
    
    $palabra_oculta= colocarLetras($palabra_oculta,posicionesLetra($palabra,$_POST["letra"]),strtoupper($_POST["letra"]));
    if($palabra_oculta == $_SESSION["oculta"]){
        $mensaje = "Letra incorrecta";
        $_SESSION["vidas"]--;
    }else{$mensaje = "Letra correcta";}
    $_SESSION["oculta"] = $palabra_oculta;

}


if(count($_SESSION["letras"])==0){
    echo(count($_SESSION["letras"]));
    $partidas_jugadas = $_COOKIE["contadorjugadas"];
    $partidas_jugadas++;
    setcookie("contadorjugadas",$partidas_jugadas,time()+3600*24*360);
    
}




if($_SESSION["vidas"]==0){
    $mensaje = "Fin de la partida";
}
if($_SESSION["palabra"]==$_SESSION["oculta"]){
    $_SESSION["ganar"]=true;
    $mensaje= "HAS GANADO";
    $partidas_ganadas = $_COOKIE["contadorganadas"];
    $partidas_ganadas++;
    setcookie("contadorganadas",$partidas_ganadas,time()+3600*24*360);
}





//Mostrar datos (1 punto)

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego ahorcado</title>
</head>
<body>
    <div>Mensajes: <?= $mensaje ?> </div>
    <div>Letras jugadas: <?= implode(", ",  $_SESSION["letras"]); ?></div>
    <div>Palabra: <?= $_SESSION["oculta"]?>  Longitud: <?= strlen($_SESSION["oculta"])?></div>
    <div>Vidas: <?= $_SESSION["vidas"]?></div>
    <form action="" method="post">
        <input type="text" name="letra" id="letra">
        <input type="submit" value="Comprobar">
    </form>
    <div>Partidas ganadas: <?= $partidas_ganadas?>  / Partidas jugadas: <?= $partidas_jugadas;?></div>
    <div>Palabra: <?= $palabra?></div>
</body>
</html>
