<?php


use app\Controller\Admin;
use app\Infrastructure\Http\Response;


//ROTA MANUTENCAO
$obRouter->get('/admin/manutencao/{codcomputador}', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $codcomputador) {
        return new Response(200, \app\Presentation\Controller\Admin\RegistrarManutencao::getManutencao($request, $codcomputador));
    }
]);

$obRouter->post('/admin/manutencao/{codcomputador}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request,$codcomputador) {
        return new Response(200, \app\Presentation\Controller\Admin\RegistrarManutencao::setManutencao($request,$codcomputador));
    }
]);
