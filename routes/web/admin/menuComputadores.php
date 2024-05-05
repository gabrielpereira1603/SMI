<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

//ROTA DE INSERIR RECLAMACAO (GET)
$obRouter->get('/admin/computador/{codlaboratorio}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request,$codlaboratorio) {
        return new Response(200, \app\Presentation\Controller\Admin\MenuComputadores::getComputador($request, $codlaboratorio));
    }
]);
