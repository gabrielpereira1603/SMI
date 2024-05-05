<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

include __DIR__.'/relatorioManutencao.php';

//ROTA DE RELATORIO
$obRouter->get('/admin/relatorio',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerarRelatorio\GerarRelatorio::getRelatorio($request));
    }
]);