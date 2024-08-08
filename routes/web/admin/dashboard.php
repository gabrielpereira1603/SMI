<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\Dashboard\Dashboard;

//ROTA Admin
$obRouter->get('/admin/dashboard',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Dashboard::getIndex($request));
    }
]);

