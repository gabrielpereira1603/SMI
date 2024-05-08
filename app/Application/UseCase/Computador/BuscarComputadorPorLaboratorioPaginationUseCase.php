<?php

namespace app\Application\UseCase\Computador;

use app\Domain\Repository\Computador\BuscarComputadorLaboratorioPaginationRepository;
use app\Infrastructure\Http\Request;

class BuscarComputadorPorLaboratorioPaginationUseCase
{
    private BuscarComputadorLaboratorioPaginationRepository $buscarComputadorLaboratorioPaginationRepository;

    public function __construct(BuscarComputadorLaboratorioPaginationRepository $buscarComputadorLaboratorioPaginationRepository)
    {
        $this->buscarComputadorLaboratorioPaginationRepository = $buscarComputadorLaboratorioPaginationRepository;
    }

    public function execute(Request $request,&$obPagination, $codlaboratorio, $limit, $offset)
    {
        return $this->buscarComputadorLaboratorioPaginationRepository->buscarComputadorPorLaboratorioPagination($request,$obPagination, $codlaboratorio,  $limit, $offset);
    }
}