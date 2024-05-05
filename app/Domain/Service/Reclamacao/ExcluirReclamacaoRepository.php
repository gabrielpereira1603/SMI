<?php

namespace app\Domain\Service\Reclamacao;

interface ExcluirReclamacaoRepository
{
    public function excluirReclamacao(int $codreclamacao) : bool;
}