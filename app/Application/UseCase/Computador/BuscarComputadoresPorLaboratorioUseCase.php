<?php

namespace app\Application\UseCase\Computador;

use app\Domain\Repository\Computador\BuscarComputadorPorLaboratorioRepository;
use app\Infrastructure\Http\Request;

class BuscarComputadoresPorLaboratorioUseCase
{
    private BuscarComputadorPorLaboratorioRepository $buscarComputadorPorLaboratorioRepository;

    public function __construct(BuscarComputadorPorLaboratorioRepository $buscarComputadorPorLaboratorioRepository)
    {
        $this->buscarComputadorPorLaboratorioRepository = $buscarComputadorPorLaboratorioRepository;
    }

    public function execute(Request $request, $codlaboratorio)
    {
       return $this->buscarComputadorPorLaboratorioRepository->buscarComputadorPorLaboratorio($request, $codlaboratorio);
    }
}