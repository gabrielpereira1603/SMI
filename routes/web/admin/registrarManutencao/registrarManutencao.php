<?php
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\RegistrarManutencao;
use app\Presentation\Controller\Admin\RegistrarManutencao\ViewRegistrarManutencao;


//ROTA MANUTENCAO
$obRouter->get('/admin/manutencao/{codcomputador}', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $codcomputador) {
        return new Response(200, ViewRegistrarManutencao::buscarDadosReclamacao($request,$codcomputador));
    }
]);

$obRouter->post('/admin/manutencao/{codcomputador}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request,$codcomputador) {
        return new Response(200, RegistrarManutencao::setManutencao($request,$codcomputador));
    }
]);
