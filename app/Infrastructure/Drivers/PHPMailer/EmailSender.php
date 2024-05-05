<?php

namespace app\Infrastructure\Drivers\PHPMailer;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailSender
{
    protected PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }


    public function sendEmail($recipient, $subject, $body): bool
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.titan.email';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'suporte@somosdevteam.com';
            $this->mailer->Password = '@G4b11416#';
            $this->mailer->SMTPSecure = 'ssl';
            $this->mailer->Port = 465;

            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->Encoding = 'base64';
            $this->mailer->setFrom('suporte@somosdevteam.com', 'Somos Devs');
            $this->mailer->addAddress($recipient);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML(true);
            $this->mailer->Body = $body;

            // Envia o e-mail
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Erro ao enviar e-mail: {$this->mailer->ErrorInfo}");
            return false;
        }
    }
}