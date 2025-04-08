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
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $assunto = $_POST['subject'];
        $mensagem = $_POST['message'];
        $context = '';
        $status_email = false;

        $mail = new PHPMailer(true);

        try 
        {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Username = 'contato@higoroliveira.com.br';
            $mail->Password = '1305#Empreender';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->setFrom('contato@higoroliveira.com.br');
            $mail->addAddress($email, $nome);
            $mail->Subject = $assunto;
            $mail->isHTML(true); 
            $mail->msgHTML(file_get_contents(__DIR__ . '/../Views/message-email.html'), __DIR__);
            $mail->Body = $mensagem;
            //$mail->addAttachment('test.txt');
            if (!$mail->send()) {
                //echo 'Mailer Error: ' . $mail->ErrorInfo . "<br><br>";
                $context = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
                $status_email = false;
            } else {
                //echo 'The email message was sent.' . "<br><br>";
                $context = "E-mail enviado com sucesso!";
                $status_email = true;
            }
        } catch (Exception $e) 
        {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" . "<br><br>";
            $context = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
            $status_email = false;
        }

        $context = 
        [
            'title' => 'Contato',
            'context' => $context,
            'status_email' => $status_email,
            'active_contact' => 'active',
        ];
        include __DIR__ . '/../Views/contact.php';
    }
}