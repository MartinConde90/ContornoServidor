<?php
require_once(dirname(__FILE__)."/Libro.php");

class XmlLibro extends Libro{
    private $xmlDoc;
    private $xsldoc;
    private $xsl;
    
    public function __construct(private $xml, private $xslt=null){

        //XML A HTML CON XSLT
        //cargamos fichero a transformar
        $dept = new DOMDocument();
        $dept->load(dirname(__FILE__)."/books.xml");
        //cargar transformacion
        $transformacion = new DOMDocument();
        $transformacion->load(dirname(__FILE__)."/books.xslt");
        //crear procesador
        $procesador = new XSLTProcessor();
        //asociar el procesador y la transformacion
        $procesador-> importStylesheet($transformacion);
        //transformar
        $transformada = $procesador->transformToXml($dept);

        echo $transformada;
            if(!is_null($this->xslt)){

            }
    }





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

    public static function appendLibro($xmlDoc,$libro){
 
        $book= $xmlDoc->createElement("book");
        $book->setAttribute("id",$libro->getID());
    

        $author= $xmlDoc->createElement("author",$libro->getAutor());
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

        $xmlDoc->documentElement->appendChild($book);

        return $xmlDoc;
    }

    

}