<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Api\Autenticacao\AutenticacaoControllerJWT;

$obRouter->post('/api/v1/auth',[
    'middlewares' => [
        'api'
    ],
    function($request) {

        return new Response(201, AutenticacaoControllerJWT::generateToken($request), 'application/json');
    }
]);