<?php

namespace app\Http\Middleware\alunoLogin;

use app\Http\Request;
use app\Http\Response;
use app\Session\Aluno\Login as SessionUserLogin;

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