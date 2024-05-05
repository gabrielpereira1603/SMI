<?php

namespace app\Infrastructure\Http\Middleware\adminLogin;

use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Infrastructure\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogin{

    /**
     * Metodo responsavel por executar o midleware
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, $next): Response
    {
        //VERIFICA SE O USUARIO ESTA LOGANDO
        if(!SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin/login');
        }

        //CONTINUA A EXECUCAO
        return $next($request);
    }
}