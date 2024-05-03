<?php

namespace app\Controller\Admin;

use app\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Model\UseCase\Usuario\ValidaLogin\LoginAdminStrategy;
use app\Model\UseCase\Usuario\ValidaLogin\ValidaLoginUseCase;
use app\Session\Admin\Login as SessionAdminLogin;
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

            $validaLoginUseCase = new ValidaLoginUseCase();
            $validaLoginUseCase->execute($login, $senha, new LoginAdminStrategy());

            $request->getRouter()->redirect('/admin');
        } catch (LoginOuSenhaInvalidosException $e) {
            // Se o login ou senha estiverem incorretos, redireciona para a página de login com mensagem de erro
            $request->getRouter()->redirect('/admin/login?error=' . urlencode($e->getMessage()));
        } catch (PermissaoDeAcessoNegadaException $e) {
            // Se o acesso for negado, redireciona para a página de login com mensagem de erro
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