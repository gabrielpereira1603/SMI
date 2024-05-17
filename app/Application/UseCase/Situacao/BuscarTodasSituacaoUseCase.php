<?php

namespace app\Application\UseCase\Situacao;

use app\Domain\Exceptions\Situacao\ErrorAoBuscarSituacaoException;
use app\Domain\Repository\Situacao\BuscarTodasSituacaoRepository;
use app\Infrastructure\Http\Request;

class BuscarTodasSituacaoUseCase
{
    private BuscarTodasSituacaoRepository $buscarTodasSituacaoRepository;

    public function __construct(BuscarTodasSituacaoRepository $buscarTodasSituacaoRepository)
    {
        $this->buscarTodasSituacaoRepository = $buscarTodasSituacaoRepository;
    }

    public function execute(Request $request): ?array
    {
        $obSituacao = $this->buscarTodasSituacaoRepository->buscarTodos($request);

        if(!$obSituacao)
        {
            throw new ErrorAoBuscarSituacaoException("Não exite situações cadastradas.");
        }

        return $obSituacao;
    }

}