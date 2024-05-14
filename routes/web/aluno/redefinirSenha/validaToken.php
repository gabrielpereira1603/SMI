<?php

use app\Infrastructure\DataBase\Usuario\BuscarTokenUsuarioDAO;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\RedefinirSenha\RedefinirSenha;
use app\Presentation\Controller\Aluno\RedefinirSenha\ValidaToken;


//ROTA LOGIN
$obRouter->get('/aluno/validaToken',[
    'middlewares' => [
        'required-redefinirSenha'
    ],
    function(Request $request) {
        return new Response(200, ValidaToken::getViewValidaToken($request));
    }
]);

//ROTA LOGIN
$obRouter->post('/aluno/validaToken',[
    'middlewares' => [
        'required-redefinirSenha'
    ],
    function(Request $request) {
        $validaToken = new ValidaToken(
            new BuscarTokenUsuarioDAO
        );
        return new Response(200, $validaToken->validaToken($request));
    }
]);