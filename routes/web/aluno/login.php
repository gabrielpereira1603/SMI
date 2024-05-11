<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\Login;


//ROTA LOGIN
$obRouter->get('/login',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, Login::getLogin($request));
    }
]);

//ROTA LOGIN(POST)
$obRouter->post('/login',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200, Login::setLogin($request));
    }

]);

//ROTA LOGOUT
$obRouter->get('/logout',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, Login::setLogout($request));
    }
]);