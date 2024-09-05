<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\Regras;

//ROTA LOGIN
$obRouter->get('/admin/regras',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Regras::getView($request));
    }
]);