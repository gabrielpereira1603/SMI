<?php

namespace app\Application\UseCase\Reclamacao;

use app\Domain\Entity\Reclamacao;
use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Domain\Repository\Reclamacao\BuscarReclamacaoPorComputadorRepository;
use app\Infrastructure\Http\Request;

class BuscarReclamacaoPorComputadorUseCase
{
    private BuscarReclamacaoPorComputadorRepository $buscarReclamacaoPorComputadorRepository;

    public function __construct(BuscarReclamacaoPorComputadorRepository $buscarReclamacaoPorComputadorRepository)
    {
        $this->buscarReclamacaoPorComputadorRepository = $buscarReclamacaoPorComputadorRepository;
    }

    public function execute(Request $request, $codcomputador): ?Reclamacao
    {

        $obReclamacao = $this->buscarReclamacaoPorComputadorRepository->buscarReclamacao($codcomputador, $statusReclamacao = 'Aberta');
        if ($obReclamacao === null) {
            throw new ReclamacoesNaoEncontradasExceptions("Nenhuma reclamação encontrada!");
        }

        return $obReclamacao;
    }

}