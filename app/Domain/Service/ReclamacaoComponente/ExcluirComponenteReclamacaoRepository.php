<?php

namespace app\Domain\Service\ReclamacaoComponente;

interface ExcluirComponenteReclamacaoRepository
{
    public function excluirComponenteReclamacao(int $codreclamacao): bool;
}