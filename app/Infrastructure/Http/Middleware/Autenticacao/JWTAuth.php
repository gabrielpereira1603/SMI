<?php

namespace app\Http\Middleware\Autenticacao;

use app\Http\Request;
use app\Model\Dao\Usuario\UsuarioDao;
use app\Model\Entity\Usuario;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth
{
    /*
     * Metodo responsavel por retorna uma isntacia de usuario autenticado
     */
    private function getJWTAuthUser(Request $request)
    {
        //recebe os headers
        $headers = $request->getHeaders();

        //token puro em jwt
        $jwt = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : '';

        try {
            //decode
            $decode = (array)JWT::decode($jwt, new Key(getenv('JWT_KEY'), 'HS256'));
        }catch (\Exception $e) {
            throw new \Exception("Token Inválido", 400);
        }
        
        //login passado pelo payload
        $login = $decode['login'] ?? '';

        //busca usuario pelo login
        $obUser = (new UsuarioDao())->getByLogin($login);

        //VERIFICA SE É UMA INSTANCIA DE USUARIO E RETORNA USUARIO
        return $obUser instanceof Usuario ? $obUser : false;
    }

    /*
     * Metodo responsavel por validar o acesso via HTTP JWT
     */
    private function auth($request)
    {
        //verifica o usuario recebido
        if ($obUser = $this->getJWTAuthUser($request)){
            $request->user = $obUser;
            return true;
        }

        //emite o error de senha invalida
        throw  new \Exception("Acesso negado!", 403);
    }

    /*
     * Metodo responsavel por executar o middleware
     */
    public function handle($request,$next)
    {
        //realiza a validacao do acesso via jwt
        $this->auth($request);

        //executa o proximo nivel de middleware
        return $next($request);
    }
}