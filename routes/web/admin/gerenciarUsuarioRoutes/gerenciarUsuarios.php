<?php

include __DIR__ . '/adicionarUserRoute.php';
include __DIR__ . '/alterarAcessoRoute.php';

use app\Controller\Admin;
use app\Http\Response;

//ROTA Admin
$obRouter->get('/admin/user',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Admin\GerenciarUser\GerenciarUsuario::getViewGerenciarUser($request));
    }
]);

