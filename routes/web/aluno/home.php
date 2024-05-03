<?php

use \app\Http\Response;
use \app\Controller\Aluno;

//ROTA Admin
$obRouter->get('/aluno/home',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200,Aluno\Home::getHome($request));
    }
]);

