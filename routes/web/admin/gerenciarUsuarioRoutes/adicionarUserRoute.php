<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

$obRouter->get('/admin/user/add',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerenciarUser\AdicionarUsuario::getNewUser($request));
    }
]);

//ROTA ADD USER(post)
$obRouter->post('/admin/user/add',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerenciarUser\AdicionarUsuario::setNewUser($request));
    }
]);
