<?php

namespace app\Domain\Repository\Reclamacao;

interface ExcluirReclamacaoRepository
{
    public function excluirReclamacao(int $codreclamacao) : bool;
}