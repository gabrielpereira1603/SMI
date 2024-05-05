<?php

use app\Controller\Aluno;
use app\Infrastructure\Http\Response;

include __DIR__.'/editarReclamacao.php';
include __DIR__.'/excluirReclamacao.php';

//ROTA Reclamacoes Abertas
$obRouter->get('/aluno/reclamacoesAbertas',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Aluno\Reclamacoes\ReclamacoesAbertas::getViewReclamacoesAbertas($request));
    }
]);

