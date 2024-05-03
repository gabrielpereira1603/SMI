<?php

namespace app\Model\UseCase\Usuario\Aluno\CriarConta;

use app\Controller\EnviaEmail\EmailSender;
use app\Exceptions\CriarUsuarioAluno\LoginOuEmailExistentes;
use app\Model\Dao\Usuario\UsuarioDao;
use app\Utils\Email\CriaContaAluno\CriaContaEmail;

class CriarUsuarioAlunoUseCase
{
    public function validaInformacoes($nome,$email,$login,$senha): bool
    {
        $usuarioDao = new UsuarioDao();

        $loginExistente = $usuarioDao->getByLogin($login);
        $emailExistente = $usuarioDao->getByEmail($email);

        if ($emailExistente !== null) {
            throw new LoginOuEmailExistentes("Email existente, Insira outro!");
        }

        if ($loginExistente != null){
            throw new LoginOuEmailExistentes("Login existente, Insira outro!");
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        if ($usuarioDao->createUsuario($login, $email, $nome, 1, $senhaHash)) {
            $enviarEmail = (new CriaContaEmail())->enviarEmailBoasVindas($nome,$email);
            return true;
        } else {
            throw new \RuntimeException("Erro ao criar usuário.");
        }
    }
}
