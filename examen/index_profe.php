<?php
//Variables
//Crea la constante PALABRAS con el array "suerte","GANAR","perder","aprobar"  (1 punto)
define("PALABRAS1",["suerte","GANAR","perder","aprobar"]);
const PALABRAS = ["suerte","GANAR","perder","aprobar"];
$palabra = "APROBAR";
$palabra_oculta = "______"; //Tantos guiones como letras tiene $palabra
$letras = [];  // Letras jugadas por el jugador en la partida actual
$vidas = 7; //Vidas de las que dispone el jugador para adivinar la $palabra
$mensaje = null;  //Mensajes a mostrar el jugador: letra repetida, ha gando, ha perdido, ...
$partidas_jugadas = 0;  //Partidas totales jugadas por el jugador
$partidas_ganadas = 0; //Partidas ganadas por el jugador

//Código que necesites incluir y no este definido --> (0,25 puntos)
session_start();
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
function posiscionesLetra($palabra,$letra) {
    $resultado = [];
    $pos = 0;
    while (($pos = strpos($palabra,$letra,$pos)) !== false){
          $resultado[] = $pos;
          $pos++;
    }
    return (count($resultado)>0)?$resultado:false;
}
//var_dump(PosiscionesLetra("GANAR","Z"));
 



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
function colocarletras($palabra_oculta,$posiciones,$letra) {
    foreach($posiciones as $pos) {
        $palabra_oculta[$pos] = $letra;
    }
    return $palabra_oculta;
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

function cargarestadojuego(&$palabra,&$palabra_oculta,&$letras,&$vidas,&$partidas_jugadas,&$partidas_ganadas) {
   if (isset($_SESSION["palabra"])) {
        $palabra = $_SESSION["palabra"];
        $palabra_oculta = $_SESSION["palabra_oculta"];
        $letras = $_SESSION["letras"];
        $vidas = $_SESSION["vidas"];
   } else {
       iniciarjuego($palabra,$palabra_oculta,$letras,$vidas);
   }
   if (isset($_COOKIE["partidas_jugadas"]) && isset($_COOKIE["partidas_ganadas"])) {
        $partidas_jugadas =$_COOKIE["partidas_jugadas"];
        $partidas_ganadas =$_COOKIE["partidas_ganadas"];
   }
}






/**
 * inciarjuego
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

 function iniciarjuego(&$palabra,&$palabra_oculta,&$letras,&$vidas,$ganar=null,&$partidas_jugadas=null,&$partidas_ganadas=null) {
    //$palabra = strtoupper(PALABRAS[random_int(0,count(PALABRAS)-1)]);
    $palabra = strtoupper(PALABRAS[array_rand(PALABRAS)]);
    $palabra_oculta = str_repeat("_",strlen($palabra));
    //for ($i=0; $i<strlen($palabra);$i++) {
    //    $palabra_oculta[$i] = "_";
    //}
    $letras = [];
    $vidas = 7;
    if (!is_null($ganar)) {
        if ($ganar == true) {
            $partidas_ganadas++;
        }
        setcookie("partidas_ganadas",$partidas_ganadas,time()+36000000);
        setcookie("partidas_jugadas",++$partidas_jugadas,time()+36000000);
    }

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
function guardarestadojuego($palabra,$palabra_oculta,$letras,$vidas) {
    $_SESSION["palabra"] = $palabra;
    $_SESSION["palabra_oculta"] = $palabra_oculta;
    $_SESSION["letras"] = $letras;
    $_SESSION["vidas"] = $vidas;
}




//Control del juego (2,25 puntos)
/*
Utiliza aquí las funciones creadas anteriormente y haz que el juego funcione
*/
cargarestadojuego($palabra,$palabra_oculta,$letras,$vidas,$partidas_jugadas,$partidas_ganadas);
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["letra"]) && $_POST["letra"] !="") {
    $letra = strtoupper($_POST["letra"]);
    $letras[] = $letra;
    $posiciones = PosiscionesLetra($palabra,$letra);
    if ($posiciones) {
        $palabra_oculta = colocarletras($palabra_oculta,$posiciones,$letra);
        if ($palabra == $palabra_oculta) {
            $mensaje = "Has GANADO";
            iniciarjuego($palabra,$palabra_oculta,$letras,$vidas,true,$partidas_jugadas,$partidas_ganadas);  
        }
    } else {
        $vidas--;
    }
    if ($vidas < 1) {
        $mensaje = "Has perdido la palabra era: $palabra";
        iniciarjuego($palabra,$palabra_oculta,$letras,$vidas,false,$partidas_jugadas,$partidas_ganadas);
    }
}



guardarestadojuego($palabra,$palabra_oculta,$letras,$vidas);
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
    <div>Mesajes: <?=(isset($mensaje))?$mensaje:"" //Muestra aquí los mensajes si son necesaios ?> </div>
    <div>Letras jugadas: <?=(is_array($letras))?implode(", ",$letras):"" //Muestra aquí las letras juegadas por el jugador en la partida actual ?></div>
    <div>Palabra: <?=$palabra_oculta //Muestra $palabra_oculta?>  Longitud: <?=strlen($palabra) //indica la longitud de la palabra oculta?></div>
    <div>Vidas: <?=$vidas //muestra el número de $vidas que le restan al jugador en la partida actual?></div>
    <form action="" method="post">
        <input type="text" name="letra" id="letra">
        <input type="submit" value="Comprobar">
    </form>
    <div>Partidas ganadas: <?=$partidas_ganadas //muestra $partidas_ganadas?>  / Partidas jugadas: <?=$partidas_jugadas //muestra $partidas_jugadas?></div>
    <div>Palabra: <?=$palabra //muestra la palabra a adivinar para ayudarte a dupurar el programa?></div>
</body>
</html>