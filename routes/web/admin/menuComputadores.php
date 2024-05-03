<?php

use \app\Http\Response;
use \app\Controller\Admin;

//ROTA DE INSERIR RECLAMACAO (GET)
$obRouter->get('/admin/computador/{codlaboratorio}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request,$codlaboratorio) {
        return new Response(200,Admin\MenuComputadores::getComputador($request, $codlaboratorio));
    }
]);
