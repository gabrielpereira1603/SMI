<?php

namespace app\Application\UseCase\Usuario;

use app\Domain\Exceptions\Usuario\UsuarioNaoEncontradoException;
use app\Domain\Repository\Usuario\BuscarTodosUsuarioAdminRepository;
use app\Infrastructure\Http\Request;

class BuscarTodosUsuarioAdminUseCase
{
    private BuscarTodosUsuarioAdminRepository $buscarTodosUsuarioAdminRepository;

    public function __construct(BuscarTodosUsuarioAdminRepository $buscarTodosUsuarioAdminRepository)
    {
        $this->buscarTodosUsuarioAdminRepository = $buscarTodosUsuarioAdminRepository;
    }

    public function execute(Request $request)
    {
        $obUsuario = $this->buscarTodosUsuarioAdminRepository->buscarTodos($request);

        if ($obUsuario === null){
            throw new UsuarioNaoEncontradoException("Não foi possível encontrar os usuários!");
        }

        return $obUsuario;
    }

}