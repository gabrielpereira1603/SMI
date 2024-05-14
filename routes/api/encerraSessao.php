<?php

use app\Infrastructure\Http\Response;
use app\Infrastructure\Session\RedefinirSenha\SessionRedefinirSenha;

//ROTA Admin
$obRouter->get('/api/v1/encerraSessaoRedefinirSenha',[
    'middlewares' => [
        'api',
    ],
    function($request) {
        return new Response(200, SessionRedefinirSenha::logout(), 'application/json');
    }
]);

