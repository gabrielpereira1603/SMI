<?php

namespace app\Application\UseCase\Laboratorio;

use app\Domain\Repository\Laboratorio\CardLaboratorioStrategy;
use app\Infrastructure\Http\Request;

class CardLaboratorioUseCase
{
    private CardLaboratorioStrategy $cardLaboratorioStrategy;

    public function __construct(CardLaboratorioStrategy $cardLaboratorioStrategy)
    {
        $this->cardLaboratorioStrategy = $cardLaboratorioStrategy;
    }

    public function execute(Request $request)
    {
        return $this->cardLaboratorioStrategy->renderCardsLaboratorios($request);
    }
}