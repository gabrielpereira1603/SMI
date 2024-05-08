<?php

namespace app\Domain\Repository\Laboratorio;

use app\Infrastructure\Http\Request;

interface CardLaboratorioStrategy
{
    public function renderCardsLaboratorios(Request $request): string;
}