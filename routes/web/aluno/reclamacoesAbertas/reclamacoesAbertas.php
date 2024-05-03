<?php

use \app\Http\Response;
use \app\Controller\Aluno;


//ROTA LOGIN
$obRouter->get('/aluno/reclamacoesAbertas',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200,Aluno\ReclamacoesAbertas::getViewReclamacoesAbertas($request));
    }
]);
