<?php

namespace app\Http\Middleware\Autenticacao;

use app\Model\Dao\Usuario\UsuarioDao;
use app\Model\Entity\Usuario;
use Closure;

class BasicAuth
{
    /*
     * Metodo responsavel por retorna uma isntacia de usuario autenticado
     */
    private function getBasicAuthUser()
    {
        //verifica a existencia dos dados de acesso
        if (!isset($_SERVER['PHP_AUTH_USER']) or !isset($_SERVER['PHP_AUTH_PW'])) {
            return false;
        }

        //busa usuario pelo login
        $obUser = (new UsuarioDao())->getByLogin($_SERVER['PHP_AUTH_USER']);

        //verifica se o resultado e uma instancia de usuario
        if (!$obUser instanceof Usuario){
            return false;
        }

        //valida senha e retorna oi usuario
        return password_verify($_SERVER['PHP_AUTH_PW'], $obUser->getSenha()) ? $obUser : false;
    }

    /*
     * Metodo responsavel por validar o acesso via HTTP basic auth
     */
    private function basicAuth($request)
    {
        //verifica o usuario recebido
        if ($obUser = $this->getBasicAuthUser()){
            $request->user = $obUser;
            return true;
        }

        //emite o error de senha invalida
        throw  new \Exception("Usuário ou senha Inválidos", 403);
    }

    /*
     * Metodo responsavel por executar o middleware
     */
    public function handle($request,$next)
    {
        //realiza a validacao do acesso via basic auth
        $this->basicAuth($request);

        //executa o proximo nivel de middleware
        return $next($request);
    }

}