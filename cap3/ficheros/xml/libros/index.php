<?php

require_once(dirname(__FILE__)."/xmlLibro.php");

$libros = [];
$xmlLibros = new DOMDocument();
$xmlLibros->load(dirname(__FILE__)."/books.xml");

/*
//PRIMERA FORMA DE HACERLO
$catalogo = $xmlLibros->documentElement; //coge el primer elemento, el raiz, en este caso es "catalog", a $catalogo aqui le pasamos un objeto
foreach($catalogo->childNodes as $hijos){
    if($hijos->nodeName == "book"){
        echo $hijos->nodeName." ". $hijos->attributes->getNamedItem("id")->nodeValue."\n";
    }
}
*/

//SEGUNDA FORMA DE HACERLO
$librosXML = $xmlLibros->getElementsByTagName("book");
foreach($librosXML as $libroxml){
    $libros[] = XmlLibro::getLibro("libroxml"); //:: llama a los metodos estaticos de la clase, no hace falta crear un new..., no se puede usar el "->"
    //echo $libro->nodeName." - ". $libro->attributes->getNamedItem("id")->nodeValue."\n";
}


if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["id"]) ) {

        $id = $_POST["id"];
        $autor = $_POST["autor"];
        $title = $_POST["titulo"];
        $genre = $_POST["genero"];
        $price = $_POST["precio"];
        $publish_date = $_POST["fecha_publicacion"];
        $description = $_POST["descripcion"];

        $libro = [$id, $autor, $title,$genre,$price,$publish_date,$description];

        XmlLibro::appendLibro($xmlLibros,$libro);

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="contenedor">
        <h2>Introduce un nuevo libro</h2>
        <form action="" method="post">
            <input class="inpt" type="text" name="id" id="id" required placeholder="id" >
            <input class="inpt" type="text" name="autor" id="autor" required placeholder="autor" >
            <input class="inpt" type="text" name="titulo" id="titulo" required placeholder="titulo" >
            <input class="inpt" type="text" name="genero" id="genero" required placeholder="genero" >
            <input class="inpt" type="text" name="precio" id="precio" required placeholder="precio" >
            <input class="inpt" type="text" name="fecha_publicacion" id="fecha_publicacion" required placeholder="fecha_publicacion" >
            <input class="inpt" type="text" name="descripcion" id="descripcion" required placeholder="descripcion" >

            <input class="boton"type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>

