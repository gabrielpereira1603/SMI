<?php

namespace app\Application\UseCase\Reclamacao;

use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Domain\Repository\Reclamacao\BuscarReclamacaoPorAlunoRepository;
use app\Infrastructure\Http\Request;

class BuscarReclamacaoPorAlunoUseCase
{
    private BuscarReclamacaoPorAlunoRepository $buscarReclamacaoPorAlunoRepository;

    public function __construct(BuscarReclamacaoPorAlunoRepository $buscarReclamacaoPorAlunoRepository)
    {
        $this->buscarReclamacaoPorAlunoRepository = $buscarReclamacaoPorAlunoRepository;
    }

    public function execute(Request $request, $codusuario): ?array
    {
        $obReclamacao = $this->buscarReclamacaoPorAlunoRepository->buscarReclamacao($request,$codusuario);

        if (!$obReclamacao){
            throw new ReclamacoesNaoEncontradasExceptions("Nenhuma reclamação encontrada!");
        }

        return $obReclamacao;
    }
}