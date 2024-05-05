<?php

namespace app\Controller\Api\Autenticacao;


use app\Model\Dao\Usuario\UsuarioDao;
use app\Model\Entity\Usuario;
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
            'login' => $obUser->getLogin()
        ];

        return [
            'token' => JWT::encode($payload, getenv('JWT_KEY'),'HS256')
        ];
    }
}