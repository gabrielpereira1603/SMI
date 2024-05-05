<?php

namespace app\Model\UseCase\Usuario\Admin;

use app\Model\Dao\Usuario\UsuarioDao;

class CriarUsuarioUseCase
{
    public const USUARIO_EXISTE = 1;
    public const SEM_PERMISSAO = 2;
    public const SUCESSO = 3;
    public const ERROR = 4;

    public function validaDadosUsuario($login,$email,$nome,$nivel_acesso,$senha): int
    {
        $userData = $_SESSION['admin']['usuario'];
        $nivel_acesso_Session = $userData['nivel_acesso'];

        if ($nivel_acesso_Session <= 2){
            return self::SEM_PERMISSAO;
        }

        $userExistente = (new UsuarioDao())->getByLogin($login);
        if (!$userExistente == null) {
            return self::USUARIO_EXISTE;
        }

        $hashPassword = password_hash($senha,PASSWORD_DEFAULT);
        $usuarioDao = new UsuarioDao();
        if($usuarioDao->createUsuario($login,$email,$nome,$nivel_acesso,$hashPassword)){
            return self::SUCESSO;
        }else {
            return self::ERROR;
        }
    }
}