<?php

namespace app\Application\UseCase\Computador;

use app\Domain\Entity\Computador;
use app\Domain\Repository\Computador\BuscarComputadorPorIdRepository;
use app\Infrastructure\Http\Request;

class BuscarComputadorPorIdUseCase
{
    private BuscarComputadorPorIdRepository $buscarComputadorPorIdRepository;

    public function __construct(BuscarComputadorPorIdRepository $buscarComputadorPorIdRepository)
    {
        $this->buscarComputadorPorIdRepository = $buscarComputadorPorIdRepository;
    }

    public function execute(int $codcomputador, Request $request): ?Computador
    {
        return $this->buscarComputadorPorIdRepository->buscaPorId($codcomputador,$request);
    }
}