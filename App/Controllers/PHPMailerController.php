<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class PHPMailerController
{
    public function PHPMailer($bodyMail, $assunto, $fromEmail, $fromName)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'postman@waysoft.net.br';
            $mail->Password = 'l2u9FHf468bh2Cxe7pcE';
            $mail->SMTPSecure = '**tls**';
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            // Defina de quem a mensagem será enviada
            $mail->setFrom($fromEmail, $fromName);
            $mail->AddReplyTo($fromEmail, $fromName);
            $mail->addAddress($fromEmail);
            //Attachments
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $bodyMail;
            $mail->AltBody = strip_tags($bodyMail);
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
}
