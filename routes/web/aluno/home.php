<?php

use app\Controller\Aluno;
use app\Infrastructure\Http\Response;

//ROTA Admin
$obRouter->get('/aluno/home',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\Home::getHome($request));
    }
]);

