<?php

namespace app\Presentation\Utilitarios\Email\CriaContaAluno;

use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Infrastructure\Drivers\PHPMailer\EmailSender;
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
        try {
            // Renderiza a view para obter o corpo do e-mail
            $body = View::render('emailBody/bemVindo/index', [
                'nome' => $nome,
            ]);

            // Configurações adicionais (assunto, etc.)
            $subject = "Seja Bem Vindo";

            $this->emailSender->sendEmail($email, $subject, $body);
        }catch (ErroAoEnviarEmailException $e){
            throw new ErroAoEnviarEmailException("Erro ao enviar e-mail de criação conta.");
        }
    }

}