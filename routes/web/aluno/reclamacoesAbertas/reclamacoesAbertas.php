<?php

use \app\Http\Response;
use \app\Controller\Aluno;


//ROTA Reclamacoes Abertas
$obRouter->get('/aluno/reclamacoesAbertas',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200,Aluno\ReclamacoesAbertas::getViewReclamacoesAbertas($request));
    }
]);

//rota de atualizar reclamcamao
$obRouter->post('/aluno/reclamacoesAbertas',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        $alterarReclamacao = new Aluno\ReclamacoesAbertas();
        return new Response(200,$alterarReclamacao->editarReclamacao($request));
    }
]);