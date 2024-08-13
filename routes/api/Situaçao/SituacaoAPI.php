<?php

use app\Infrastructure\DataBase\Situacao\BuscarTodasSituacaoDAO;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Api\Computador\ComputadorApi;

$obRouter->get('/api/v1/situacao/all',[
    'middlewares' => [
        'api',
    ],
    function($request,$codlaboratorio) {
        return new Response(200, (new BuscarTodasSituacaoDAO)->buscarTodosJSON($request), 'application/json');
    }
]);