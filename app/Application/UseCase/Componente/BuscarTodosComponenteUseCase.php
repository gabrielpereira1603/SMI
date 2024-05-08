<?php

namespace app\Application\UseCase\Componente;

use app\Domain\Entity\Componente;
use app\Domain\Repository\Componente\BuscarTodosComponenteRepository;
use app\Infrastructure\Http\Request;

class BuscarTodosComponenteUseCase
{
    private BuscarTodosComponenteRepository $buscarTodosComponenteRepository;

    public function __construct(BuscarTodosComponenteRepository $buscarTodosComponenteRepository)
    {
        $this->buscarTodosComponenteRepository = $buscarTodosComponenteRepository;
    }

    public function execute(Request $request): bool|array
    {
        return $this->buscarTodosComponenteRepository->buscarTodos($request);
    }
}