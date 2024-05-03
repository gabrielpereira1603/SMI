<?php

use app\Controller\Admin;
use app\Http\Response;

$obRouter->get('/admin/user/add',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerenciarUser\AdicionarUsuario::getNewUser($request));
    }
]);

//ROTA ADD USER(post)
$obRouter->post('/admin/user/add',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\GerenciarUser\AdicionarUsuario::setNewUser($request));
    }
]);
