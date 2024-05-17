<?php

namespace app\Application\UseCase\ReclamacaoComponente;

use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Domain\Repository\ReclamacaoComponente\BuscarComponentePorReclamacaoRepository;
use app\Infrastructure\Http\Request;

class BuscarComponentePorReclamacaoUseCase
{
    private BuscarComponentePorReclamacaoRepository $buscarComponentePorReclamacaoRepository;

    public function __construct(BuscarComponentePorReclamacaoRepository $buscarComponentePorReclamacaoRepository)
    {
        $this->buscarComponentePorReclamacaoRepository = $buscarComponentePorReclamacaoRepository;
    }

    public function execute(Request $request, $codreclamacao): ?array
    {
        
        $obComponente = $this->buscarComponentePorReclamacaoRepository->buscarComponenteReclamacao($request,$codreclamacao);

        if (!$obComponente)
        {
            throw new ReclamacoesNaoEncontradasExceptions("Componentes da reclamação não encontrado!");
        }
        return $obComponente;
    }

}