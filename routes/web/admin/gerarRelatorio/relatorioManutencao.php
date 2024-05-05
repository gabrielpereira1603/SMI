<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

$obRouter->get('/admin/relatorio/manutencao',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao::getViewRelatorioManutencao($request));
    }
]);

$obRouter->post('/admin/relatorio/manutencao',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao::getTableDataRelatorioManutencao($request));
    }
]);

//ROTA DE RELATORIO de manutencao
$obRouter->post('/admin/relatorio/PDF',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerarRelatorio\PdfRelatorioManutencao::gerarPdfRelatorioManutencao($request));
    }
]);