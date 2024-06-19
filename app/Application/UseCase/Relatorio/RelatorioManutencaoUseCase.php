<?php

namespace app\Application\UseCase\Relatorio;

use app\Domain\Repository\Relatorio\BuscarDadosRelatorioManutencaoRepository;

class RelatorioManutencao
{
    private BuscarDadosRelatorioManutencaoRepository $buscarDadosRelatorioManutencaoRepository;

    public function __construct(BuscarDadosRelatorioManutencaoRepository $buscarDadosRelatorioManutencaoRepository)
    {
        $this->buscarDadosRelatorioManutencaoRepository = $buscarDadosRelatorioManutencaoRepository;
    }

    public function execute($usuario,$laboratorio,$computador,$dataInicio,$dataFim)
    {
        $relatorio = $this->buscarDadosRelatorioManutencaoRepository->buscarDados($usuario,$laboratorio,$computador,$dataInicio,$dataFim);
    }
}