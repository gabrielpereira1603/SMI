<?php

use app\Controller\Aluno;
use app\Infrastructure\Http\Response;

//ROTA DE INSERIR RECLAMACAO (GET)
$obRouter->get('/aluno/computador/{codlaboratorio}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request,$codlaboratorio) {
        return new Response(200, \app\Presentation\Controller\Aluno\MenuComputadores::getComputador($request,$codlaboratorio));
    }
]);
