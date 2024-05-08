<?php

namespace app\Domain\Repository\Computador;

use app\Infrastructure\Http\Request;

interface BuscarComputadorPorLaboratorioRepository
{
    public function buscarComputadorPorLaboratorio(Request $request, $codlaboratorio): array;
}