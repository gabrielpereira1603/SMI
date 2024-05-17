<?php

namespace app\Domain\Repository\Computador;

interface AtualizaSituacaoRepository
{
    public function atualizaStatus(int $codcomputador, array $valoresParaAlterar): bool;

}