<?php

namespace app\Domain\Repository\Laboratorio;

use app\Domain\Entity\Laboratorio;
use app\Infrastructure\Http\Request;

interface BuscarLaboratorioPorId
{
    public function buscarPorId(Request $request, int $codlaboratorio): ?Laboratorio;
}