<?php

namespace app\Presentation\Controller\Api\Autenticacao;


use app\Domain\Entity\Usuario;
use app\Infrastructure\Dao\Usuario\UsuarioDao;
use Firebase\JWT\JWT;

class AutenticacaoControllerJWT
{
    public static function generateToken($request): array
    {
        $postVars = $request->getPostVars();

        //valida os campos obrigatorios
        if (!isset($postVars['login']) or !isset($postVars['senha'])) {
            throw new \Exception("Email e senha são obrigatórios!",400);
        }

        //buscar usuario pelo email
        $obUser = (new UsuarioDao())->getByLogin($postVars['login']);

        if (!$obUser instanceof Usuario){
            throw new \Exception("Usuário ou senha sao inválidos", 400);
        }

        //valida senha do usuario
        if (!password_verify($postVars['senha'], $obUser->getSenha())) {
            throw new \Exception("Usuário ou senha sao inválidos", 400);
        }

        //payload
        $payload = [
            'login' => 'gay'
        ];

        return [
            'token' => JWT::encode($payload, getenv('JWT_KEY'),'HS256')
        ];
    }
}