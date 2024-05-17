 <?php

use app\Infrastructure\Http\Response;
 use app\Presentation\Controller\Api\Api;
 use app\Presentation\Controller\Api\Usuario\UsuarioApi;

 $obRouter->post('/api/v1/user/{codusuario}',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request,$codusuario) {
        return new Response(200, UsuarioApi::buscarUsuarioPorID($request,$codusuario), 'application/json');
    }
]);

//rota de consulta do usuario atual
$obRouter->get('/api/v1/me',[
    'middlewares' => [
        'api',
        'jwt-auth'
    ],
    function($request) {
        return new Response(200, Api::getDetails($request), 'application/json');
    }
]);