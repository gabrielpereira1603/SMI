<?php

use app\Infrastructure\DataBase\Computador\ComputadorPorIdDAO;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Aluno\Reclamacoes\ViewRegistrarReclamacao;

//ROTA Admin
$obRouter->get('/aluno/reclamacao/{codcomputador}',[
    'middlewares' => [
        'required-aluno-login'
    ],
    function(Request $request, $codcomputador) {
        $viewRegistrarReclamacao = new ViewRegistrarReclamacao(new ComputadorPorIdDAO());
        return new Response(200,$viewRegistrarReclamacao->getViewRegistrarReclamacao($request,$codcomputador));
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