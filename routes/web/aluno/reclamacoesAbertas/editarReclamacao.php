<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\Reclamacoes\EditarReclamacao;

$obRouter->post('/aluno/reclamacoesAbertas',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function($request) {
        $editarReclamacao = new EditarReclamacao();
        return new Response(200,$editarReclamacao->editarReclamacao($request));
    }
]);