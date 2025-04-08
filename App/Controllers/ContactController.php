<?php
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactController 
{   
    public function index() 
    {
        $context = 
        [
            'title' => 'Contato',
            'context' => 'Contato',
            'active_contact' => 'active',
        ];
        include __DIR__ . '/../Views/contact.php';
    }

    public function email() 
    {
        echo $email;
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $assunto = $_POST['subject'];
        $mensagem = $_POST['message'];

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'contato@higoroliveira.com.br';
        $mail->Password = '1305#Empreender';
        $mail->setFrom($email, $nome);
        $mail->addAddress('contato@higoroliveira.com.br', 'Higor');
        $mail->Subject = $assunto;
        $mail->msgHTML(file_get_contents(__DIR__ . '/../Views/message-email.html'), __DIR__);
        $mail->Body = $mensagem;
        //$mail->addAttachment('test.txt');
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'The email message was sent.';
        }
        die();

        $context = 
        [
            'title' => 'Contato',
            'context' => 'Contato',
            'active_contact' => 'active',
        ];
        include __DIR__ . '/../Views/contact.php';
    }
}