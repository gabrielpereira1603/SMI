<?php

namespace app\Application\UseCase\Usuario\Admin;

use app\Domain\Repository\Usuario\BuscarUsuarioPorLoginRepository;
use app\Infrastructure\Dao\Usuario\UsuarioDao;

class CriarUsuarioUseCase
{
    private BuscarUsuarioPorLoginRepository $buscarUsuarioPorLoginRepository;
    private CadastrarUsuarioRepository $cadastrarUsuarioRepository;

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