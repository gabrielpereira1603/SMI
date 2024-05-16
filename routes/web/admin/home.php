<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\Home;

//ROTA Admin
$obRouter->get('/admin',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Home::getHome($request));
    }
]);

