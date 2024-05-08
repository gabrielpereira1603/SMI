<?php

namespace app\Application\UseCase\Laboratorio;

use app\Domain\Repository\Laboratorio\BuscarTodosLaboratoriosRepository;
use app\Infrastructure\Http\Request;

class BuscarTodosLaboratoriosUseCase
{
    private BuscarTodosLaboratoriosRepository $buscarTodosLaboratoriosRepository;

    public function __construct(BuscarTodosLaboratoriosRepository $buscarTodosLaboratoriosRepository)
    {
        $this->buscarTodosLaboratoriosRepository = $buscarTodosLaboratoriosRepository;
    }

    public function execute(Request $request)
    {
        return $this->buscarTodosLaboratoriosRepository->buscarTodosLaboratorios($request);
    }
}