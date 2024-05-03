<?php

use \app\Http\Response;
use \app\Controller\Admin;

include __DIR__.'/relatorioManutencao.php';

//ROTA DE RELATORIO
$obRouter->get('/admin/relatorio',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerarRelatorio\GerarRelatorio::getRelatorio($request));
    }
]);