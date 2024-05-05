<?php

namespace app\Presentation\Controller\Admin;

use app\Application\UseCase\Usuario\ValidaLogin\LoginAdminStrategy;
use app\Application\UseCase\Usuario\ValidaLogin\ValidaLoginUseCase;
use app\Domain\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Domain\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Infrastructure\Session\Admin\Login as SessionAdminLogin;
use app\Utils\View;

class Login extends Page
{

    public static function getLogin($request): string
    {
        $content = View::render('admin/login',[
        ]);

        return parent::getPage('Login',$content);
    }

    public static function setLogin($request): void
    {
        try {
            $postVars = $request->getPostVars();
            $login = $postVars['login'] ?? '';
            $senha = $postVars['senha'] ?? '';

            $validaLoginUseCase = new ValidaLoginUseCase(new LoginAdminStrategy());
            $validaLoginUseCase->execute($login, $senha);

            $request->getRouter()->redirect('/admin');
        } catch (LoginOuSenhaInvalidosException|PermissaoDeAcessoNegadaException $e) {
            $request->getRouter()->redirect('/admin/login?error=' . urlencode($e->getMessage()));
        }
    }

    public static function setLogout($request): void
    {
        //DESTRO A SESSAO DE LOGIN
        SessionAdminLogin::logout();

        //REDIRECIONA O USUARIO PARA A TELA DE LOGIN
        $request->getRouter()->redirect('/admin/login');
    }
}