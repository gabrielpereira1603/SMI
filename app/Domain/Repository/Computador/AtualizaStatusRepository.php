<?php

namespace app\Domain\Repository\Computador;

interface AtualizaStatusRepository
{
    public function atualizaStatus(int $codcomputador, array $valoresParaAlterar): bool;

}