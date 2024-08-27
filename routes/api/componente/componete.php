<?php

use app\Application\UseCase\ReclamacaoComponente\BuscarComponentePorReclamacaoUseCase;
use app\Domain\Exceptions\Componente\ErroAoBuscarComponentePorReclamacaoException;
use app\Infrastructure\DataBase\Componente\BuscarTodosComponentesDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Api\Componente\ComponenteApi;

$obRouter->post('/api/v1/componente',[
    'middlewares' => [
        'api',
        //'jwt-auth'
    ],
    function($request) {
        $componenteApi = new ComponenteApi(new BuscarTodosComponentesDAO());
        try {
            $componenteApi->getAllComponentes($request);
            return new Response(200, $componenteApi->getAllComponentes($request), 'application/json');
        }catch (\RuntimeException $e) {
            return new Response(500, ['error' => $e->getMessage()], 'application/json');
        }
    }
]);


$obRouter->post('/api/v1/componente/{codreclamacao}',[
    'middlewares' => [
        'api',
        //'jwt-auth'
    ],
    function($request,$codreclamacao) {
        $useCase = new BuscarComponentePorReclamacaoUseCase(
            new BuscarComponentePorReclamacaoDAO()
        );

        try {
            $useCase->execute($request,$codreclamacao);
            return new Response(200, $useCase->execute($request,$codreclamacao), 'application/json');
        } catch (ErroAoBuscarComponentePorReclamacaoException $e){
            return new Response(500, ['error' => $e->getMessage()], 'application/json');
        }
    }
]);