<?php

namespace app\Http\Middleware\alunoLogin;

use app\Http\Request;
use app\Http\Response;
use app\Session\Aluno\Login as SessionAlunoLogin;

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