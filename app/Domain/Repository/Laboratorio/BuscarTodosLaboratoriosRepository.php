<?php

namespace app\Domain\Repository\Laboratorio;

use app\Infrastructure\Http\Request;

interface BuscarTodosLaboratoriosRepository
{
    public function buscarTodosLaboratorios(Request $request): array;
}