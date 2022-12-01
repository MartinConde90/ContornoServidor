<?php
use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";
$mail = new PHPMailer();
$mail->IsSMTP();
//Cambiar a 0 para no ver mensajes de error
$mail->SMTPDebug = 2;
$mail->SMTPAuth = false;
//$mail->SMTPSecure = "tls";
$mail->Host = "10.10.32.8";
$mail->Port = 25;
// introducir usurario de google
$mail->Username = "";
//introducir clave
$mail->Password = "";
$mail->SetFrom('martinconde90@gmail.com', 'Test');
// asunto
$mail->Subject = "Correo de prueba";
// cuerpo
$mail->MsgHTML('Prueba');
// adjuntos
$mail->addAttachment("texto.txt");
// destinatario
$address = "martinconde1990@gmail.com";
$mail->AddAddress($address, "Test");
// enviar
$resul = $mail->Send();
if(!$resul){
    echo "Error". $mail->ErrorInfo;
}else{
    echo "Enviado";
}
