<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Api\Api;
use app\Presentation\Controller\Api\Usuario\UsuarioApi;

$obRouter->get('/api/v1/user/{codusuario}', [
    'middleware' => [
        'api'
    ],
    function($request, $codusuario) {
        // Chama o método na sua API ou na sua lógica de negócio
        return new Response(200, UsuarioApi::buscarUsuarioPorID($request, $codusuario), 'application/json');
    }
]);