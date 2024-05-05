<?php

namespace app\Infrastructure\Session\Aluno;

use app\Session\Aluno\User;

class Login {

    /**
     * Metodo responsavel por iniciar a sessao
     */
    private static function init(): void
    {
        //VERIFICA SE A SESSAO NAO ESTA ATIVA
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();    
        }
    }
    /**
     * Metodo responsavel por criar o login do usuario
     * @param User
     * @return boolean
     */
    public static function login($obUser): bool
    {
        //INICIA A SESSAO
        self::init();

        //DEFINE A SESSAO DO USUARIO
        $_SESSION['aluno']['usuario'] = [
            'codusuario' => $obUser->getCodusuario(),
            'nome_usuario' => $obUser->getNomeUsuario(),
            'email_usuario' => $obUser->getEmailUsuario(),
            'login' => $obUser->getLogin(),
            'nivel_acesso' => $obUser->getNivelAcesso()->getCodNivelAcesso(),
            'tipo_acesso' => $obUser->getNivelAcesso()->getTipoAcesso(),
        ];

        //SUCESSO
        return true;
    }

    /**
     * Metodo reponsavel por verificar se o usuario esta logado
     * @return boolean 
     * */    
    public static function isLogged(): bool
    {
        //INICIA A SESSAO
        self::init(); 

        //RETORNA A VERIFICACAO
        return isset($_SESSION['aluno']['usuario']['codusuario']);
    }

    /**
     * Metodo responsavel por executar logout do usuario
     * @return boolean
     */
    public static function logout(): bool
    {
        //INICIA A SESSAO
        self::init();

        //DESLOGA O USUARIO
        unset($_SESSION['aluno']['usuario']);
        
        //SUCESSO
        return true;
    }
}