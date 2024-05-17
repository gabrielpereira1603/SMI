<?php

namespace app\Application\UseCase\Componente;

use app\Domain\Exceptions\Computador\ErrorAoAlterarSituacaoComputador;
use app\Domain\Repository\Computador\AtualizaSituacaoRepository;

class AtualizaSituacaoComputadorUseCase
{
    private AtualizaSituacaoRepository $atualizaSituacaoRepository;

    public function __construct(AtualizaSituacaoRepository $atualizaSituacaoRepository)
    {
        $this->atualizaSituacaoRepository = $atualizaSituacaoRepository;
    }

    public function execute($codcomputador, array $dadosAlterar){

        if (!$this->atualizaSituacaoRepository->atualizaStatus($codcomputador,$dadosAlterar)){
            throw new ErrorAoAlterarSituacaoComputador("Error ao alterar a situação do computador!");
        }

        return true;
    }
}