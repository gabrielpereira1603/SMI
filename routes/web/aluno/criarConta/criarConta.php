<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\CriarConta\CriarConta;

//ROTA Admin
$obRouter->get('/aluno/novaConta',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, CriarConta::getViewCriarConta($request));
    }
]);

//ROTA Admin
$obRouter->post('/aluno/novaConta',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, CriarConta::setNovoUsuarioAluno($request));
    }
]);

