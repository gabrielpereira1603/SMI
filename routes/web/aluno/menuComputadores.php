<?php

use \app\Http\Response;
use \app\Controller\Aluno;

//ROTA DE INSERIR RECLAMACAO (GET)
$obRouter->get('/aluno/computador/{codlaboratorio}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request,$codlaboratorio) {
        return new Response(200, Aluno\MenuComputadores::getComputador($request,$codlaboratorio));
    }
]);
