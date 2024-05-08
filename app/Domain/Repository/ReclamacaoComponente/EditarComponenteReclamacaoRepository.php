<?php

namespace app\Domain\Repository\ReclamacaoComponente;

interface EditarComponenteReclamacaoRepository
{
    public function removerComponenteReclamacao(int $codReclamacao): bool;

    public function inserirComponenteReclamacao(int $codreclamacao, int $componente): bool;
}