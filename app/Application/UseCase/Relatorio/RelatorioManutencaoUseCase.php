<?php

namespace app\Application\UseCase\Relatorio;

use app\Domain\Exceptions\Relatorio\ErrorAoBuscarRelatorioManutencaoException;
use app\Domain\Repository\Relatorio\BuscarDadosRelatorioManutencaoRepository;

class RelatorioManutencaoUseCase
{
    private BuscarDadosRelatorioManutencaoRepository $buscarDadosRelatorioManutencaoRepository;

    public function __construct(BuscarDadosRelatorioManutencaoRepository $buscarDadosRelatorioManutencaoRepository)
    {
        $this->buscarDadosRelatorioManutencaoRepository = $buscarDadosRelatorioManutencaoRepository;
    }

    public function execute($usuario,$laboratorio,$computador,$dataInicio,$dataFim)
    {
        $relatorio = $this->buscarDadosRelatorioManutencaoRepository->buscarDados($usuario,$laboratorio,$computador,$dataInicio,$dataFim);
        if ($relatorio === null){
            throw new ErrorAoBuscarRelatorioManutencaoException("Error ao gerar relatório de manutenção!");
        }
        return $relatorio;
    }
}