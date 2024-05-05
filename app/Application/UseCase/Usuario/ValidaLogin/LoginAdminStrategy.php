<?php

namespace app\Application\UseCase\Usuario\ValidaLogin;

use app\Domain\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Domain\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Domain\Service\Usuario\ValidaLogin\ValidaLoginRepository;
use app\Infrastructure\Dao\Usuario\UsuarioDao;
use app\Infrastructure\Session\Admin\Login as SessionAdminLogin;

class LoginAdminStrategy implements ValidaLoginRepository
{
    public function validaLogin(string $login, string $senha): void
    {
        $usuarioDao = new UsuarioDao();

        $usuario = $usuarioDao->getByLogin($login);

        if (empty($usuario)){
            throw new LoginOuSenhaInvalidosException("Login ou Senha incorretos.");
        }

        $codNivelAcesso = $usuario->getNivelAcesso()->getCodNivelAcesso();

        if ($codNivelAcesso == 1 || $codNivelAcesso == 4){
            throw new PermissaoDeAcessoNegadaException("Usuário sem permissão para acessar.");
        }

        if(!password_verify($senha, $usuario->getSenha())){
            throw new LoginOuSenhaInvalidosException("Login ou Senha incorretos.");
        }

        SessionAdminLogin::login($usuario);
    }
}