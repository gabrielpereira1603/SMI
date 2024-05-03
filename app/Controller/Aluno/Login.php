<?php

namespace app\Controller\Aluno;


use app\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Model\UseCase\Usuario\ValidaLogin\LoginAlunoStrategy;
use app\Model\UseCase\Usuario\ValidaLogin\ValidaLoginUseCase;
use app\Session\Aluno\Login as SessionLoginAluno;
use app\Utils\View;

class Login extends Page
{
    public static function getLogin($request): bool|array|string
    {
        $content = View::render('aluno/login',[
        ]);
        return parent::getPage('Login Aluno',$content);
    }

    public static function setLogin($request): void
    {
        try {
            $postVars = $request->getPostVars();
            $login = $postVars['login'] ?? '';
            $senha = $postVars['senha'] ?? '';

            $validaLoginUseCase = new ValidaLoginUseCase();
            $validaLoginUseCase->execute($login, $senha, new LoginAlunoStrategy());

            $request->getRouter()->redirect('/aluno/home');
        } catch (LoginOuSenhaInvalidosException $e) {
            // Se o login ou senha estiverem incorretos, redireciona para a página de login com mensagem de erro
            $request->getRouter()->redirect('/login?error=' . urlencode($e->getMessage()));
        } catch (PermissaoDeAcessoNegadaException $e) {
            // Se o acesso for negado, redireciona para a página de login com mensagem de erro
            $request->getRouter()->redirect('/login?error=' . urlencode($e->getMessage()));
        }
    }

    public static function setLogout($request): void
    {
        //DESTRO A SESSAO DE LOGIN
        SessionLoginAluno::logout();

        //REDIRECIONA O USUARIO PARA A TELA DE LOGIN
        $request->getRouter()->redirect('/login');
    }
}