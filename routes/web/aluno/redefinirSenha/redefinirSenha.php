<?php

use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\RedefinirSenha\RedefinirSenha;


//ROTA LOGIN
$obRouter->get('/aluno/redefinirSenha',[
    'middlewares' => [
        'required-redefinirSenha'
    ],
    function(Request $request) {
        return new Response(200, RedefinirSenha::getViewRedefinirSenha($request));
    }
]);

//ROTA LOGIN
$obRouter->post('/aluno/redefinirSenha',[
    'middlewares' => [
        'required-redefinirSenha'
    ],
    function(Request $request) {
        return new Response(200, RedefinirSenha::redefinirSenha($request));
    }
]);


