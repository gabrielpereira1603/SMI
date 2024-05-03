<?php

use \app\Http\Response;
use \app\Controller\Aluno;

//ROTA Admin
$obRouter->get('/aluno/reclamacao/{codcomputador}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request,$codcomputador) {
        return new Response(200,Aluno\RegistrarReclamacao::getViewReclamacao($request,$codcomputador));
    }
]);

$obRouter->post('/aluno/reclamacao/{codcomputador}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request, $codcomputador) {
        $registrarReclamacao = new Aluno\RegistrarReclamacao();
        return new Response(200, $registrarReclamacao->setReclamacao($request, $codcomputador));
    }
]);