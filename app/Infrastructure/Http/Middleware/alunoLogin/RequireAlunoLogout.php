<?php

namespace app\Infrastructure\Http\Middleware\alunoLogin;

use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Infrastructure\Session\Aluno\Login as SessionAlunoLogin;

class RequireAlunoLogout{

    /**
     * Metodo responsavel por executar o midleware
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, $next){
        //VERIFICA SE O USUARIO ESTA LOGANDO
        if(SessionAlunoLogin::isLogged()){
            $request->getRouter()->redirect('/aluno/home');
        }

        //CONTINUA A EXECUCAO
        return $next($request);
    }
}