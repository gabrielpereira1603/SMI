<?php


use app\Infrastructure\Http\Response;

$obRouter->post('/admin/manutencao/{codcomputador}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request,$codcomputador) {
        return new Response(200, RegistrarManutencao::setManutencao($request,$codcomputador));
    }
]);

