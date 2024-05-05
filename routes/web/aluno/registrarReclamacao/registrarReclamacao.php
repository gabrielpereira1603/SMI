<?php

use app\Controller\Aluno;
use app\Infrastructure\Http\Response;

//ROTA Admin
$obRouter->get('/aluno/reclamacao/{codcomputador}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request,$codcomputador) {
        return new Response(200, \app\Presentation\Controller\Aluno\Reclamacoes\RegistrarReclamacao::getViewReclamacao($request,$codcomputador));
    }
]);

$obRouter->post('/aluno/reclamacao/{codcomputador}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request, $codcomputador) {
        $registrarReclamacao = new \app\Presentation\Controller\Aluno\Reclamacoes\RegistrarReclamacao();
        return new Response(200, $registrarReclamacao->setReclamacao($request, $codcomputador));
    }
]);