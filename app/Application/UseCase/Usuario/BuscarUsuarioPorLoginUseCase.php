<?php

namespace app\Application\UseCase\Usuario;

use app\Domain\Entity\Usuario;
use app\Domain\Exceptions\Usuario\UsuarioNaoEncontradoException;
use app\Domain\Repository\Usuario\BuscarUsuarioPorLoginRepository;
use app\Infrastructure\Http\Request;

class BuscarUsuarioPorLoginUseCase
{
    private BuscarUsuarioPorLoginRepository $buscarUsuarioPorLoginRepository;
    
    public function __construct(BuscarUsuarioPorLoginRepository $buscarUsuarioPorLoginRepository)
    {
        $this->buscarUsuarioPorLoginRepository = $buscarUsuarioPorLoginRepository;
    }

    public function execute(Request $request, $login): ?Usuario
    {
        $obUsuario = $this->buscarUsuarioPorLoginRepository->buscarAluno($request,$login);
        if ($obUsuario === null){
            return null;
        }
        return $obUsuario;
    }
}