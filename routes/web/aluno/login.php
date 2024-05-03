<?php

use \app\Http\Response;
use \app\Controller\Aluno;


//ROTA LOGIN
$obRouter->get('/login',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200,Aluno\Login::getLogin($request));
    }
]);

//ROTA LOGIN(POST)
$obRouter->post('/login',[
    'middlewares' => [
        'required-aluno-logout'
    ],
    function($request) {
        return new Response(200,Aluno\Login::setLogin($request));
    }

]);

//ROTA LOGOUT
$obRouter->get('/logout',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200,Aluno\Login::setLogout($request));
    }
]);