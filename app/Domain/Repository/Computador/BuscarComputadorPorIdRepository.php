<?php

namespace app\Domain\Repository\Computador;

use app\Domain\Entity\Computador;
use app\Infrastructure\Http\Request;

interface BuscarComputadorPorIdRepository
{
    public function buscaPorId(int $codcomputador, Request $request): ?Computador;
}