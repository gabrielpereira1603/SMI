<?php

namespace app\Presentation\Utilitarios\Email\CadastrarManutencao;

use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Infrastructure\Drivers\PHPMailer\EmailSender;
use app\Utils\View;

class CadastrarManutencaoEmail
{
    protected EmailSender $emailSender;

    public function __construct()
    {
        $this->emailSender = new EmailSender();
    }

    public function enviarManutencaoRealizada(string $email, $nomeAluno): void
    {
        try {

            // Renderiza a view para obter o corpo do e-mail
            $body = View::render('emailBody/finalizarManutencao/index', [
                'nome' => $nomeAluno,
            ]);

            // Configurações adicionais (assunto, etc.)
            $subject = "Manutenção finalizada com sucesso.";
            $this->emailSender->sendEmail($email, $subject, $body);

        } catch (ErroAoEnviarEmailException $e) {
            throw new ErroAoEnviarEmailException("Erro ao enviar e-mail de cadastro de reclamação.");
        }
    }
}