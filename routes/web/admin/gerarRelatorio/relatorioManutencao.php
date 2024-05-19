<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao\ViewRelatorioManutencao;

$obRouter->get('/admin/relatorio/manutencao',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, ViewRelatorioManutencao::getView($request));
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