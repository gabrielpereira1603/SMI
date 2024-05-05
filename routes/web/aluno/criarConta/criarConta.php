<?php

use app\Controller\Aluno;
use app\Infrastructure\Http\Response;

//ROTA Admin
$obRouter->get('/aluno/novaConta',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\CriarConta\CriarConta::getViewCriarConta($request));
    }
]);

//ROTA Admin
$obRouter->post('/aluno/novaConta',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\CriarConta\CriarConta::setNovoUsuarioAluno($request));
    }
]);

