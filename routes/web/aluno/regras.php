<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\Login;


//ROTA LOGIN
$obRouter->get('/aluno/regras',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\ViewTermosDeUso::getView($request));
    }
]);