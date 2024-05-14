<?php

use app\Infrastructure\Http\Response;
use app\Infrastructure\Session\RedefinirSenha\SessionRedefinirSenha;

//ROTA Admin
$obRouter->get('/encerraSessaoRedefinirSenha',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, SessionRedefinirSenha::logout());
    }
]);

