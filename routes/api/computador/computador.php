<?php

use app\Controller\Api;
use app\Infrastructure\Http\Response;

$obRouter->post('/api/v1/computador/{codlaboratorio}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request,$codlaboratorio) {
        return new Response(200, \app\Presentation\Controller\Api\Computador\ComputadorApi::getComputadoresPorLab($request,$codlaboratorio), 'application/json');
    }
]);