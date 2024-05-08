<?php

namespace app\Domain\Repository\ReclamacaoComponente;

interface ExcluirComponenteReclamacaoRepository
{
    public function excluirComponenteReclamacao(int $codreclamacao): bool;
}