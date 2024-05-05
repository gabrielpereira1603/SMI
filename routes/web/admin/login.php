<?php

use app\Controller\Admin;
use app\Infrastructure\Http\Response;


//ROTA LOGIN
$obRouter->get('/admin/login',[
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\Login::getLogin($request));
    }
]);

//ROTA LOGIN(POST)
$obRouter->post('/admin/login',[
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\Login::setLogin($request));
    }

]);

//ROTA LOGOUT
$obRouter->get('/admin/logout',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\Login::setLogout($request));
    }
]);