<?php

namespace app\Infrastructure\Http\Middleware\alunoLogin;

use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Infrastructure\Session\Aluno\Login as SessionUserLogin;

class RequireAlunoLogin{

    /**
     * Metodo responsavel por executar o midleware
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, $next): Response
    {
        //VERIFICA SE O USUARIO ESTA LOGANDO
        if(!SessionUserLogin::isLogged()){
            $request->getRouter()->redirect('/login');
        }

        //CONTINUA A EXECUCAO
        return $next($request);
    }
}