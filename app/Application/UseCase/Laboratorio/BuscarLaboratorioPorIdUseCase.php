<?php

namespace app\Application\UseCase\Laboratorio;

use app\Domain\Entity\Laboratorio;
use app\Domain\Repository\Laboratorio\BuscarLaboratorioPorId;
use app\Infrastructure\Http\Request;

class BuscarLaboratorioPorIdUseCase
{
    private BuscarLaboratorioPorId $buscarLaboratorioPorId;

    public function __construct(BuscarLaboratorioPorId $buscarLaboratorioPorId)
    {
        $this->buscarLaboratorioPorId = $buscarLaboratorioPorId;
    }

    public function execute(Request $request, int $codLaboratorio): ?Laboratorio
    {
        return $this->buscarLaboratorioPorId->buscarPorId($request, $codLaboratorio);
    }
}