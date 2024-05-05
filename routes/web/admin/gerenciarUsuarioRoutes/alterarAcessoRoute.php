<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

$obRouter->get('/admin/user/acesso',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerenciarUser\AlterarAcessoUsuario::getAcesso($request));
    }
]);

$obRouter->post('/admin/user/acesso',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerenciarUser\AlterarAcessoUsuario::setAcesso($request));
    }
]);
