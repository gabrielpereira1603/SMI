<?php
use app\Infrastructure\Http\Response;

include __DIR__ . '/adicionarUserRoute.php';
include __DIR__ . '/alterarAcessoRoute.php';
include __DIR__ . '/alterarDadosRoute.php';



//ROTA Admin
$obRouter->get('/admin/user',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, \app\Presentation\Controller\Admin\GerenciarUser\GerenciarUsuario::getViewGerenciarUser($request));
    }
]);

