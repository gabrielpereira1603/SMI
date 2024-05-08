<?php

use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\Reclamacoes\ExcluirReclamacao;

$obRouter->post('/reclamacoesAbertas/delete',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function(Request $request) {
        $excluirReclamacao = new ExcluirReclamacao();
        return new Response(200,$excluirReclamacao->excluirReclamacao($request));
    }
]);