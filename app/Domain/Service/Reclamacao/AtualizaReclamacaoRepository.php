<?php

namespace app\Domain\Service\Reclamacao;

interface AtualizaReclamacaoRepository
{
    // exemplo de valores a ser alterado $codcomputador, ['codsituacao_fk' => '1']
    public function atualizaReclamacao(int $codreclamacao, array $valoresParaAlterar): bool;

}