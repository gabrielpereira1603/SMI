<?php

namespace app\Infrastructure\Http\Middleware\RedefinirSenha;

use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Infrastructure\Session\Aluno\Login as SessionUserLogin;
use app\Infrastructure\Session\RedefinirSenha\SessionRedefinirSenha;
use app\Presentation\Controller\Aluno\RedefinirSenha\RedefinirSenha;

class RequireSessionRedefinirSenha
{
    /**
     * Metodo responsavel por executar o midleware
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, $next): Response
    {
        //VERIFICA SE O USUARIO ESTA LOGANDO
        if(!SessionRedefinirSenha::isLogged()){
            $request->getRouter()->redirect('/login');
        }

        if (SessionRedefinirSenha::sessionExpired()) {
            // Se a sessão expirou, redireciona para a tela de login
            $request->getRouter()->redirect('/login');
        }

        //CONTINUA A EXECUCAO
        return $next($request);
    }
}