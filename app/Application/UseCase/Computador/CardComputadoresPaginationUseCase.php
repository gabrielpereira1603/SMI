<?php

namespace app\Application\UseCase\Computador;

use app\Domain\Repository\Computador\CardComputadorStrategy;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Pagination;

class CardComputadoresPaginationUseCase
{
    private CardComputadorStrategy $cardComputadorStrategy;

    public function __construct(CardComputadorStrategy $cardComputadorStrategy)
    {
        $this->cardComputadorStrategy = $cardComputadorStrategy;
    }

    public function execute(Request $request, &$pagination, $codlaboratorio)
    {
        return $this->cardComputadorStrategy->renderCardComputadores($request, $pagination, $codlaboratorio);
    }
}