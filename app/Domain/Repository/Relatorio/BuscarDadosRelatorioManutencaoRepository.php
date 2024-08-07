<?php

namespace app\Domain\Repository\Relatorio;

interface BuscarDadosRelatorioManutencaoRepository
{
    public function buscarDados($usuario,$laboratorio,$computador,$dataInicio,$dataFim): ?array;
}