<?php


use \app\Http\Response;
use \app\Controller\Admin;


//ROTA MANUTENCAO
$obRouter->get('/admin/manutencao/{codcomputador}', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $codcomputador) {
        return new Response(200, Admin\RegistrarManutencao::getManutencao($request, $codcomputador));
    }
]);

$obRouter->post('/admin/manutencao/{codcomputador}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request,$codcomputador) {
        return new Response(200,Admin\RegistrarManutencao::setManutencao($request,$codcomputador));
    }
]);
