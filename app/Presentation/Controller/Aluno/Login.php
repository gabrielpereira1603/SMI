<?php

namespace app\Presentation\Controller\Aluno;


use app\Application\UseCase\Usuario\ValidaLogin\LoginAlunoStrategy;
use app\Application\UseCase\Usuario\ValidaLogin\ValidaLoginUseCase;
use app\Domain\Exceptions\LoginExeptions\LoginOuSenhaInvalidosException;
use app\Domain\Exceptions\LoginExeptions\PermissaoDeAcessoNegadaException;
use app\Infrastructure\Session\Aluno\Login as SessionLoginAluno;
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

            $validaLoginUseCase = new ValidaLoginUseCase(new LoginAlunoStrategy());
            $validaLoginUseCase->execute($request,$login, $senha);

            $request->getRouter()->redirect('/aluno/home');
        } catch (LoginOuSenhaInvalidosException|PermissaoDeAcessoNegadaException $e) {
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