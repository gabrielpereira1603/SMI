<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Utilitarios\Email\CriaContaAluno\CriaContaEmail;


$obRouter->post('/api/v1/email/{email}/{nome}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request, $email, $nome) {
        $enviarEmail = new CriaContaEmail();
        try {
            $enviarEmail->enviarEmailBoasVindas($nome, $email);
            return new Response(200, ['message' => 'Email enviado com sucesso'], 'application/json');
        } catch (\RuntimeException $e) {
            return new Response(500, ['error' => $e->getMessage()], 'application/json');
        }
    }
]);