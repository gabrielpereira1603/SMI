<?php

namespace app\Utils\Email\CadastrarReclamacao;

use app\Controller\EnviaEmail\EmailSender;
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
        $userData = $_SESSION['aluno']['usuario'];
        $nome = $userData['nome_usuario'];

        // Renderiza a view para obter o corpo do e-mail
        $body = View::render('emailBody/cadastroReclamacao/index',[
            'nome' => $nome,
        ]);

        // Configurações adicionais (assunto, etc.)
        $subject = "Reclamação cadastrada com sucesso.";

        // Envia o e-mail
        if (!$this->emailSender->sendEmail($email, $subject, $body)) {
            throw new \RuntimeException("Erro ao enviar e-mail de cadastro de reclamação.");
        }
    }

}