<?php

use app\Controller\Api;
use app\Infrastructure\Http\Response;

$obRouter->post('/api/v1/componente',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Api\Componente\ComponenteApi::getAllComponentes($request), 'application/json');
    }
]);


$obRouter->post('/api/v1/componente/{codreclamacao}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request,$codreclamacao) {
        return new Response(200, \app\Presentation\Controller\Api\Componente\ComponenteApi::getComponentesReclamacao($request,$codreclamacao), 'application/json');
    }
]);