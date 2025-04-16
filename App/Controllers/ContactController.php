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
        $data = date("d-M-Y H:i:s");

        $mail = new PHPMailer(true);

        try 
        {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Username = USER_EMAIL_CONFIG;
            $mail->Password = EMAIL_PW;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->setFrom(USER_EMAIL_CONFIG, $nome);
            $mail->addAddress(USER_EMAIL_CONFIG);
            $mail->Subject = $assunto;
            $mail->isHTML(true); 
            //$mail->msgHTML(file_get_contents(__DIR__ . '/../Views/message-email.html'), __DIR__);
            $mail->Body = "<strong>Contato enviado em $data </strong><br><br> 
            Nome: $nome
            E-mail: $email
            Assunto: $assunto
            Mensagem: $mensagem";
            
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo . "<br><br>";
                $context = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
                $status_email = false;
                echo "<script>
                Swal.fire({
                title: 'Ops!',
                text: 'Erro ao enviar e-mail, tente mais tarde!',
                icon: 'danger'
                }); windows.location.href='/contato';</script>";
            } else {
                echo 'The email message was sent.' . "<br><br>";
                $context = "E-mail enviado com sucesso!";
                $status_email = true;
                echo "<script>
                Swal.fire({
                title: 'Pronto!',
                text: 'E-mail enviado com sucesso!',
                icon: 'success'
                }); windows.location.href='/contato';</script>";
            }
        } catch (Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" . "<br><br>";
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
        //include __DIR__ . '/../Views/contact.php';
        header('Location: /contato.php');
    }
}