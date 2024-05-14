<?php

namespace app\Application\UseCase\Usuario;

use app\Domain\Exceptions\Usuario\ErrorAoRedefinirSenhaException;
use app\Domain\Repository\Usuario\RedefinirSenhaUsuarioRepository;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Session\RedefinirSenha\SessionRedefinirSenha;

class RedefinirSenhaUsuarioUseCase
{
    private RedefinirSenhaUsuarioRepository $redefinirSenhaUsuarioRepository;

    public function __construct(RedefinirSenhaUsuarioRepository $redefinirSenhaUsuarioRepository)
    {
        $this->redefinirSenhaUsuarioRepository = $redefinirSenhaUsuarioRepository;
    }

    public function execute(Request $request, $senha)
    {
        $userdata = $_SESSION['redefinirSenha']['usuario'];
        $codusuario = $userdata['codusuario'];

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        var_dump($senhaHash,$codusuario);
        if (!$this->redefinirSenhaUsuarioRepository->redefinirSenha($codusuario,['senha' => $senhaHash])){
            throw new ErrorAoRedefinirSenhaException("Não foi possível redefinir a senha do usuário!");
        }

        SessionRedefinirSenha::logout();
        return true;
    }
}