<?php

namespace app\Application\UseCase\Usuario\ValidaLogin;

use app\Application\UseCase\Usuario\BuscarUsuarioPorLoginUseCase;
use app\Domain\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Domain\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Domain\Repository\Usuario\ValidaLoginRepository;
use app\Infrastructure\DataBase\Usuario\BuscarUsuarioPorLoginDAO;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Session\Admin\Login as SessionAdminLogin;

class LoginAdminStrategy implements ValidaLoginRepository
{
    public function validaLogin(Request $request, string $login, string $senha): void
    {
        $useCase = new BuscarUsuarioPorLoginUseCase(
          new BuscarUsuarioPorLoginDAO()
        );

        $obUsuario = $useCase->execute($request,$login);

        if (empty($obUsuario)){
            throw new LoginOuSenhaInvalidosException("Login ou Senha incorretos.");
        }

        $codNivelAcesso = $obUsuario->getNivelAcesso()->getCodNivelAcesso();

        if ($codNivelAcesso == 1 || $codNivelAcesso == 4){
            throw new PermissaoDeAcessoNegadaException("Usuário sem permissão para acessar.");
        }

        if(!password_verify($senha, $obUsuario->getSenha())){
            throw new LoginOuSenhaInvalidosException("Login ou Senha incorretos.");
        }

        SessionAdminLogin::login($obUsuario);
    }
}