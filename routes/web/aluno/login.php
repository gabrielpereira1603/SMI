<?php

use app\Controller\Aluno;
use app\Infrastructure\Http\Response;


//ROTA LOGIN
$obRouter->get('/login',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\Login::getLogin($request));
    }
]);

//ROTA LOGIN(POST)
$obRouter->post('/login',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\Login::setLogin($request));
    }

]);

//ROTA LOGOUT
$obRouter->get('/logout',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\Login::setLogout($request));
    }
]);