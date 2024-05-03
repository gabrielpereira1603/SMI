<?php

use \app\Http\Response;
use \app\Controller\Api;

$obRouter->post('/api/v1/auth',[
    'middlewares' => [
        'api'
    ],
    function($request) {
        return new Response(201,Api\Autenticacao\AutenticacaoControllerJWT::generateToken($request), 'application/json');
    }
]);