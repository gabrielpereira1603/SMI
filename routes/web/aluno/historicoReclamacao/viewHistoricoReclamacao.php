<?php


use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\HistoricoReclamacoes\ViewHistoricoReclamacoes;


//ROTA Reclamacoes Abertas
$obRouter->get('/aluno/historicoReclamacao', [
    'middlewares' => [
        'required-aluno-login'
    ],
    function ($request) {
        return new Response(200, ViewHistoricoReclamacoes::getViewReclamacoesAbertas($request));
    }
]);

