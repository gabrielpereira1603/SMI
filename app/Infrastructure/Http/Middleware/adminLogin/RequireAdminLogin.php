<?php

namespace app\Http\Middleware\adminLogin;

use app\Http\Request;
use app\Http\Response;
use app\Session\Admin\Login as SessionAdminLogin;

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