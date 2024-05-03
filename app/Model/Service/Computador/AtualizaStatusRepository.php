<?php

namespace app\Model\Service\Computador;

interface AtualizaStatusRepository
{
    // exemplo de valores a ser alterado $codcomputador, ['codsituacao_fk' => '1']
    public function atualizaStatus(int $codcomputador, array $valoresParaAlterar): bool;

}