<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Variables
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->charSet = "UTF-8";
    $mail->Encoding = 'base64';
    $mail->Host       = 'smtp-mail.outlook.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'testesgrazi@hotmail.com';
    $mail->Password   = 'Th1s1smyt3st1ngp@ssw0rd';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = '587';

    //Recipients
    $mail->setFrom('testesgrazi@hotmail.com', 'Mailer');
    $mail->addAddress('testesgrazi@hotmail.com', 'Contato');     //Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');

    //Content
    $bodyContent = "
    <h3>Dados do formulário:</h3>
    <div><b>Nome:</b> $nome</div>
    <div><b>Email:</b> $email</div>
    ";

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = utf8_decode('Formulário de contato CooperPlus');
    $mail->Body    = utf8_decode($bodyContent);
    $mail->AltBody = 'Habilite a visualização HTML para ver o conteúdo.';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
