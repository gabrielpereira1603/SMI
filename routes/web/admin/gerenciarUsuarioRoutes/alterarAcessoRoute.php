<?php

use app\Http\Response;
use app\Controller\Admin;

$obRouter->get('/admin/user/acesso',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerenciarUser\AlterarAcessoUsuario::getAcesso($request));
    }
]);

$obRouter->post('/admin/user/acesso',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerenciarUser\AlterarAcessoUsuario::setAcesso($request));
    }
]);
