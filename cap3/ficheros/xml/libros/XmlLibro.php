<?php
require_once(dirname(__FILE__)."/Libro.php");

class XmlLibro extends Libro{

    public static function getLibro($xmlLibro){
        $libro = new Libro(
            $xmlLibro->attributes->getNamedItem("id")->nodeValue,
            $xmlLibro->getElementsByTagName("author")->item(0)->textContent, //getElementsByTagName, al estar en plural, devuelve un Array de los elementos con esa Tag, en este caso solo tenemos 1
            $xmlLibro->getElementsByTagName("title")->item(0)->textContent,
            $xmlLibro->getElementsByTagName("genre")->item(0)->textContent,
            $xmlLibro->getElementsByTagName("price")->item(0)->textContent,
            $xmlLibro->getElementsByTagName("publish_date")->item(0)->textContent,
            $xmlLibro->getElementsByTagName("description")->item(0)->textContent
        );
        return $libro;
    }

    public static function appendLibro(&$xmlDoc,$libro){
 
        $catalogo = $xmlDoc->documentElement;

        $book= $xmlDoc->createElement("book");
        $book->setAttribute("id",$libro->getID);
        
        $catalogo->appendChild($book);

        $author= $xmlDoc->createElement("author",$libro->getAuthor());
        $book->appendchild($author);

        $title= $xmlDoc->createElement("title",$libro->getTitle());
        $book->appendchild($title);

        $genre= $xmlDoc->createElement("genre",$libro->getGenre());
        $book->appendchild($genre);

        $price= $xmlDoc->createElement("price",$libro->getPrice());
        $book->appendchild($price);

        $publish_date= $xmlDoc->createElement("publish_date",$libro->getPublish_date());
        $book->appendchild($publish_date);

        $description= $xmlDoc->createElement("description",$libro->getDescription());
        $book->appendchild($description);

        
    }
}