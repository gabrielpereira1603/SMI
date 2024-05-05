<?php

namespace app\Application\UseCase\Usuario\Aluno\CriarConta;

use app\Domain\Exceptions\CriarUsuarioAluno\LoginOuEmailExistentes;
use app\Infrastructure\Dao\Usuario\UsuarioDao;
use app\Presentation\Utilitarios\Email\CriaContaAluno\CriaContaEmail;

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
