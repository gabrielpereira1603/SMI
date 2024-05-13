<?php

use app\Application\UseCase\Usuario\GerarTokenRedefinirSenhaUseCase;
use app\Infrastructure\DataBase\Usuario\BuscarUsuarioPorEmailDAO;
use app\Infrastructure\DataBase\Usuario\GerarTokenRedefinirSenhaDAO;
use app\Infrastructure\Http\Response;


$obRouter->post('/api/v1/email/{email}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request,$email) {
        $gerarToken = new GerarTokenRedefinirSenhaUseCase(
            new GerarTokenRedefinirSenhaDAO(),
            new BuscarUsuarioPorEmailDAO()
        );
        try {
            $gerarToken->execute($request,$email);
            return new Response(200, ['message' => 'Email enviado com sucesso'], 'application/json');
        } catch (\RuntimeException $e) {
            return new Response(500, ['error' => $e->getMessage()], 'application/json');
        }
    }
]);