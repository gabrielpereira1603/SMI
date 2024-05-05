<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

//ROTA Admin
$obRouter->get('/admin/user',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\User::getUser($request));
    }
]);

