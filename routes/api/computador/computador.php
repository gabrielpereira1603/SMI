<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Api\Computador\ComputadorApi;

$obRouter->post('/api/v1/computador/{codlaboratorio}',[
    'middlewares' => [
        'api',
    ],
    function($request,$codlaboratorio) {
        return new Response(200, ComputadorApi::getComputadoresPorLab($request,$codlaboratorio), 'application/json');
    }
]);