<?php

namespace app\Presentation\Utilitarios\Email\GerarTokenRedefinirSenha;

use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Infrastructure\Drivers\PHPMailer\EmailSender;
use app\Utils\View;

class EnviarEmailTokenRedefinirSenha
{
    protected EmailSender $emailSender;

    public function __construct()
    {
        $this->emailSender = new EmailSender();
    }

    public function enviarEmailToken(string $nome, int $token, string $email): void
    {
        try {
            // Renderiza a view para obter o corpo do e-mail
            $body = View::render('emailBody/tokenRedefinirSenha/index', [
                'nome' => $nome,
                'token' => $token

            ]);

            // Configurações adicionais (assunto, etc.)
            $subject = "Solicitação de redefinição de senha";

            $this->emailSender->sendEmail($email, $subject, $body);
        }catch (ErroAoEnviarEmailException $e){
            throw new ErroAoEnviarEmailException("Erro ao enviar e-mail de redefinição de senha.");
        }
    }
}