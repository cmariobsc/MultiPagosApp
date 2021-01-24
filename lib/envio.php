<?php
require("class.phpmailer.php");
require("class.smtp.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                                        // Establecer el método de envío

$mail->Host = "mail.hostalcasameyer.com";                                // Establecer el servidor
$mail->SMTPAuth = true;                                                // Establecer autenticación SMTP
$mail->Username = "test@hostalcasameyer.com";                            // SMTP username
$mail->Password = "ugvwdusav61vvs45o5";                                // SMTP password

$mail->From = "test@hostalcasameyer.com";
$mail->FromName = "remitente";                                            // remitente
$mail->AddAddress("hostalcasameyer@gmail.com", "destinatario");            // destinatario

$mail->WordWrap = 50;                                                    // Establecer el corte de textos a 50 caracteres
$mail->IsHTML(true);                                                    // Establecer formato HTML

$mail->Subject = "Asunto .....";
$mail->Body = "Este es un mensaje html <b>¡En Negrita!</b>";
$mail->AltBody = "Este es el cuerpo del correo en texto plano para clientes de correo que no soporten HTML";

if (!$mail->Send()) {
    echo "Mensaje NO enviado. <p>";
    echo "Error: " . $mail->ErrorInfo;
    exit;
}

echo "Mensaje enviado!";





//
//
//
//
//require 'PHPMailerAutoload.php';
//
//$mail = new PHPMailer;
//
////$mail->SMTPDebug = 3;                               // Enable verbose debug output
//
//$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'user@example.com';                 // SMTP username
//$mail->Password = 'secret';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    // TCP port to connect to
//
//$mail->setFrom('from@example.com', 'Mailer');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML
//
//$mail->Subject = 'Here is the subject';
//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//if(!$mail->send()) {
//    echo 'Message could not be sent.';
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}
//
//
//









