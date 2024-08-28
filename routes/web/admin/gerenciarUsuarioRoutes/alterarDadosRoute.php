<?php

use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\GerenciarUser\AlterarInformacoes;

$obRouter->get('/admin/user/update',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, AlterarInformacoes::getUpdate($request));
    }
]);

//ROTA ALTERAR INFORMACOES(post)
$obRouter->post('/admin/user/update',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200,AlterarInformacoes::setUpdate($request));
    }
]);