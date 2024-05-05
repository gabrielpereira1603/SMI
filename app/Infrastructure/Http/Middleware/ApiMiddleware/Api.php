<?php

namespace app\Infrastructure\Http\Middleware\ApiMiddleware;

class Api
{
    /*
     * Metodo responsavel por executar o middleware
     */
    public function handle($request, $next){
        //altera o content type para json
        $request->getRouter()->setContentType('application/json');
        //executa o proximo nivel do middleware
        return $next($request);
    }
}