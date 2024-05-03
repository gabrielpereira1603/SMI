<?php

namespace app\Utils\Email\CriaContaAluno;

use app\Controller\EnviaEmail\EmailSender;
use app\Utils\View;

class CriaContaEmail
{
    protected EmailSender $emailSender;

    public function __construct()
    {
        $this->emailSender = new EmailSender();
    }

    public function enviarEmailBoasVindas(string $nome, string $email): void
    {
        // Renderiza a view para obter o corpo do e-mail
        $body = View::render('emailBody/bemVindo/index',[
            'nome' => $nome,
        ]);

        // Configurações adicionais (assunto, etc.)
        $subject = "Bem-vindo ao Nosso Sistema";

        // Envia o e-mail
        if (!$this->emailSender->sendEmail($email, $subject, $body)) {
            throw new \RuntimeException("Erro ao enviar e-mail de boas-vindas.");
        }
    }

}