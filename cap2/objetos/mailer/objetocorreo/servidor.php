<?php
require_once("email.php");
use PHPMailer\PHPMailer\PHPMailer;
require "../correo/vendor/autoload.php";
class Servidor{
    private $ip;
    private $destinatario;
    private $puerto;
    private $mail;

    function __construct()
    {
        $this->ip = "10.10.32.8";
        $this->destinatario = "martincondegrande90@gmail.com";
        $this->puerto = 25;
        $this->mail = new PHPMailer();

        // destinatario
        $this->mail->AddAddress($this->destinatario, "Support");
        $this->Host =  $this->ip;
        $this->Port =  $this->puerto;

        $this->mail->IsSMTP();
        //Cambiar a 0 para no ver mensajes de error
        $this->SMTPDebug = 2;
        $this->SMTPAuth = false;
        // introducir usurario de google
        $this->Username = "";
        //introducir clave
        $this->Password = "";
        
    }

    function enviar(Email $email){
        $this->mail->SetFrom($email->getEmisor(), $email->getEmisor());
        // asunto
        $this->mail->Subject = $email->getAsunto();
        // cuerpo
        $this->mail->MsgHTML($email->getMensaje());

        $resul = $this->mail->Send();
        if(!$resul){
            echo "Error". $this->mail->ErrorInfo;
        }else{
            echo "Enviado";
        }
    }
}