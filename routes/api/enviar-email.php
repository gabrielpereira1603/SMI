<?php

use app\Controller\Api;
use app\Utils\Email\CriaContaAluno\CriaContaEmail;
use app\Utils;
use app\Http\Response;


$obRouter->get('/api/v1/email/{email}/{nome}',[
    'middlewares' => [
        'api',
        //'jwt-auth'
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