<?php

use app\Application\UseCase\ReclamacaoComponente\BuscarComponentePorReclamacaoUseCase;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Response;

$obRouter->post('/api/v1/componente',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Api\Componente\ComponenteApi::getAllComponentes($request), 'application/json');
    }
]);


$obRouter->post('/api/v1/componente/{codreclamacao}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request,$codreclamacao) {
        $useCase = new BuscarComponentePorReclamacaoUseCase(
            new BuscarComponentePorReclamacaoDAO()
        );
        return new Response(200, $useCase->execute($request,$codreclamacao), 'application/json');
    }
]);