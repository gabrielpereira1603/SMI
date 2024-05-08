<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\Home;

//ROTA Admin
$obRouter->get('/aluno/home',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, Home::getHome($request));
    }
]);

