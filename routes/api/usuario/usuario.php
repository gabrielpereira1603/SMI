<?php

use \app\Http\Response;
use \app\Controller\Api;

$obRouter->post('/api/v1/user/{codusuario}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request,$codusuario) {
        return new Response(200,Api\Usuario\UsuarioApi::buscarUsuarioPorID($request,$codusuario), 'application/json');
    }
]);

//rota de consulta do usuario atual
$obRouter->get('/api/v1/me',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request) {
        return new Response(200,Api\Api::getDetails($request), 'application/json');
    }
]);