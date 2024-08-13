<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\Configuracoes\Configuracoes;

$obRouter->get('/admin/gerenciar',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Configuracoes::index($request));
    }
]);

$obRouter->post('/admin/gerenciar/addLabs',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Configuracoes::addLab($request));
    }
]);

$obRouter->post('/admin/gerenciar/editLabs/{codlaboratorio}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request, $codlaboratorio) {
        return new Response(200, Configuracoes::editarLabs($request, $codlaboratorio));
    }
]);

$obRouter->post('/admin/gerenciar/editPc',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Configuracoes::editarComputador($request));
    }
]);