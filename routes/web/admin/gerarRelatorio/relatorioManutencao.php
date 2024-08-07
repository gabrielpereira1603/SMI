<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao\DataRelatorioManutencao;
use app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao\PdfRelatorioManutencao;
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
        return new Response(200, DataRelatorioManutencao::getTableDataRelatorioManutencao($request));
    }
]);

//ROTA DE RELATORIO de manutencao
$obRouter->post('/admin/relatorio/PDF',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, PdfRelatorioManutencao::gerarPdfRelatorioManutencao($request));
    }
]);