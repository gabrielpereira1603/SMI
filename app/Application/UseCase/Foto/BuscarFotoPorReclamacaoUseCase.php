<?php

namespace app\Application\UseCase\Foto;

use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Domain\Repository\Foto\BuscarFotoPorReclamacaoRepository;
use app\Infrastructure\Http\Request;

class BuscarFotoPorReclamacaoUseCase
{
    private BuscarFotoPorReclamacaoRepository $buscarFotoPorReclamacaoRepository;

    public function __construct(BuscarFotoPorReclamacaoRepository $buscarFotoPorReclamacaoRepository)
    {
        $this->buscarFotoPorReclamacaoRepository = $buscarFotoPorReclamacaoRepository;
    }

    public function execute(Request $request, $codreclamacao)
    {

        $obFoto = $this->buscarFotoPorReclamacaoRepository->buscarFoto($codreclamacao);

        if (!$obFoto){
            throw new ReclamacoesNaoEncontradasExceptions("Nenhuma foto anexada a reclamação");
        }

        return $obFoto;
    }

}