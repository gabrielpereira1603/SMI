<?php

namespace app\Domain\Repository\Computador;

use app\Infrastructure\Http\Request;

interface BuscarComputadorLaboratorioPaginationRepository
{
    public function buscarComputadorPorLaboratorioPagination(Request $request, &$obPagination, $codlaboratorio, $limit, $offset): array;
}