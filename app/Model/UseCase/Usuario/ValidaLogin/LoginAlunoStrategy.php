<?php

namespace app\Model\UseCase\Usuario\ValidaLogin;

use app\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Model\Dao\Usuario\UsuarioDao;
use app\Model\Service\Usuario\ValidaLogin\ValidaLoginRepository;
use app\Session\Aluno\Login as SessionAlunoLogin;

class LoginAlunoStrategy implements ValidaLoginRepository
{
    public function validaLogin(string $login, string $senha): void
    {
        $usuarioDao = new UsuarioDao();

        $usuario = $usuarioDao->getByLogin($login);

        if (empty($usuario)){
            throw new LoginOuSenhaInvalidosException("Login ou Senha incorretos.");
        }

        $codNivelAcesso = $usuario->getNivelAcesso()->getCodNivelAcesso();

        if ($codNivelAcesso >= 2){
            throw new PermissaoDeAcessoNegadaException("Usuário sem permissão para acessar.");
        }

        if(!password_verify($senha, $usuario->getSenha())){
            throw new PermissaoDeAcessoNegadaException("Usuário sem permissão para acessar.");
        }

        SessionAlunoLogin::login($usuario);
    }
}