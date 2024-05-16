<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\Login;


//ROTA LOGIN
$obRouter->get('/admin/login',[
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Login::getViewLogin($request));
    }
]);

//ROTA LOGIN(POST)
$obRouter->post('/admin/login',[
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Login::setLogin($request));
    }

]);

//ROTA LOGOUT
$obRouter->get('/admin/logout',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Login::setLogout($request));
    }
]);