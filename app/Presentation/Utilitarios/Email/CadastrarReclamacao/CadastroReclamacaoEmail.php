<?php

namespace app\Presentation\Utilitarios\Email\CadastrarReclamacao;

use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Infrastructure\Drivers\PHPMailer\EmailSender;
use app\Utils\View;

class CadastroReclamacaoEmail
{
    protected EmailSender $emailSender;

    public function __construct()
    {
        $this->emailSender = new EmailSender();
    }

    public function enviarReclamacaoRealizada(string $email): void
    {
        try {
            // Tente executar este bloco de código
            $userData = $_SESSION['aluno']['usuario'];
            $nome = $userData['nome_usuario'];

            // Renderiza a view para obter o corpo do e-mail
            $body = View::render('emailBody/cadastroReclamacao/index', [
                'nome' => $nome,
            ]);

            // Configurações adicionais (assunto, etc.)
            $subject = "Reclamação cadastrada com sucesso.";
            $this->emailSender->sendEmail($email, $subject, $body);
        } catch (ErroAoEnviarEmailException $e) {
            throw new ErroAoEnviarEmailException("Erro ao enviar e-mail de cadastro de reclamação.");
        }
    }

}