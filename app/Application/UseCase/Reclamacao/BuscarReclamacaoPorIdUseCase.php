<?php

namespace app\Application\UseCase\Reclamacao;

use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Domain\Repository\Reclamacao\BuscarReclamacaoPorIdRepository;
use app\Infrastructure\Http\Request;

class BuscarReclamacaoPorIdUseCase
{
    private BuscarReclamacaoPorIdRepository $reclamacaoPorIdRepository;
    
    public function __construct(BuscarReclamacaoPorIdRepository $reclamacaoPorIdRepository)
    {
        $this->reclamacaoPorIdRepository = $reclamacaoPorIdRepository;
    }

    public function execute(Request $request,$codreclamacao)
    {
        $obReclamacao = $this->reclamacaoPorIdRepository->buscarPorId($codreclamacao);
        if ($obReclamacao === null){
            throw new ReclamacoesNaoEncontradasExceptions("Nenhuma reclamação encontrada!");
        }
        return $obReclamacao;
    }
}