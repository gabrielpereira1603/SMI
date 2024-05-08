<?php

namespace app\Domain\Repository\Computador;

use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Pagination;

interface CardComputadorStrategy
{
    public function renderCardComputadores(Request $request, &$pagination, $codlaboratorio): array;
}