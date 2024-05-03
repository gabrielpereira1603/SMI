<?php

use \app\Http\Response;
use \app\Controller\Aluno;

//ROTA Admin
$obRouter->get('/aluno/novaConta',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, Aluno\CriarConta\CriarConta::getViewCriarConta($request));
    }
]);

//ROTA Admin
$obRouter->post('/aluno/novaConta',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, Aluno\CriarConta\CriarConta::setNovoUsuarioAluno($request));
    }
]);

