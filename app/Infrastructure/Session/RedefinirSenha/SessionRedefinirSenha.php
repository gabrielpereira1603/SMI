<?php

namespace app\Infrastructure\Session\RedefinirSenha;

class SessionRedefinirSenha
{

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
    public static function iniciaSessao($obUser): bool
    {
        //INICIA A SESSAO
        self::init();

        //DEFINE A SESSAO DO USUARIO
        $_SESSION['redefinirSenha']['usuario'] = [
            'codusuario' => $obUser->getCodusuario(),
            'nome_usuario' => $obUser->getNomeUsuario(),
            'email_usuario' => $obUser->getEmailUsuario(),
            'login' => $obUser->getLogin(),
            'nivel_acesso' => $obUser->getNivelAcesso()->getCodNivelAcesso(),
            'tipo_acesso' => $obUser->getNivelAcesso()->getTipoAcesso(),
        ];

        $_SESSION['redefinirSenha']['start_time'] = time();


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
        return isset($_SESSION['redefinirSenha']['usuario']['codusuario']);
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
        unset($_SESSION['redefinirSenha']['usuario']);
        //SUCESSO
        return true;
    }

    public static function sessionExpired(): bool
    {
        // Verifica se a sessão não existe
        if (!isset($_SESSION['redefinirSenha']['start_time'])) {
            return true; // Sessão expirou se o tempo de início não estiver definido
        }

        // Verifica se o tempo de início da sessão é maior que 15 minutos
        if (time() - $_SESSION['redefinirSenha']['start_time'] > 5) { // 900 segundos = 15 minutos
            return true; // Sessão expirou
        }

        return false; // Sessão não expirou
    }
}