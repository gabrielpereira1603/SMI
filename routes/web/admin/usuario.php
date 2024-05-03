<?php

use \app\Http\Response;
use \app\Controller\Admin;

//ROTA Admin
$obRouter->get('/admin/user',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,Admin\User::getUser($request));
    }
]);

