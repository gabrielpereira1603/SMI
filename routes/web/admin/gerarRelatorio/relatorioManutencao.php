<?php

use \app\Http\Response;
use \app\Controller\Admin;

$obRouter->get('/admin/relatorio/manutencao',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerarRelatorio\RelatorioManutencao::getViewRelatorioManutencao($request));
    }
]);

$obRouter->post('/admin/relatorio/manutencao',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerarRelatorio\RelatorioManutencao::getTableDataRelatorioManutencao($request));
    }
]);

//ROTA DE RELATORIO de manutencao
$obRouter->post('/admin/relatorio/PDF',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerarRelatorio\PdfRelatorioManutencao::gerarPdfRelatorioManutencao($request));
    }
]);