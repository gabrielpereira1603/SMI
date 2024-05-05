<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;

//ROTA Admin
$obRouter->get('/admin',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\Home::getHome($request));
    }
]);

