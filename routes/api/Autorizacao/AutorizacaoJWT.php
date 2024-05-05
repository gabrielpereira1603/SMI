<?php

use app\Controller\Api;
use app\Infrastructure\Http\Response;

$obRouter->post('/api/v1/auth',[
    'middlewares' => [
        'api'
    ],
    function($request) {
        return new Response(201, \app\Presentation\Controller\Api\Autenticacao\AutenticacaoControllerJWT::generateToken($request), 'application/json');
    }
]);