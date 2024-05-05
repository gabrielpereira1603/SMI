<?php

namespace app\Application\UseCase\Usuario\Admin;

use app\Infrastructure\Dao\Usuario\UsuarioDao;

class AtualizaAcessoUsuarioUseCase
{
    public const SEM_PERMISSAO = 1;
    public const SUCESSO = 2;
    public const ERROR = 3;
    public const NIVEL_ACESSO_NULL = 4;

    public function validaDadosUsuario($codUsuario,$nivelAcesso): int
    {
        $userData = $_SESSION['admin']['usuario'];
        $nivel_acesso_Session = $userData['nivel_acesso'];

        if ($nivel_acesso_Session <= 2){
            return self::SEM_PERMISSAO;
        }

        if ($nivelAcesso === null){
            return self::NIVEL_ACESSO_NULL;
        }

        $usuarioDao = new UsuarioDao();

        if ($usuarioDao->updateUsuario($codUsuario,['nivelacesso_fk' => $nivelAcesso])){
            return self::SUCESSO;
        }else{
            return self::ERROR;
        }
    }
}
