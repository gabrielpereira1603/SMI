<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\GerarRelatorio\ViewGerarRelatorio;

include __DIR__.'/relatorioManutencao.php';

//ROTA DE RELATORIO
$obRouter->get('/admin/relatorio',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, ViewGerarRelatorio::getRelatorio($request));
    }
]);