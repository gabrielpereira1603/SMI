<?php

namespace app\Domain\Repository\ReclamacaoComponente;

use app\Infrastructure\Http\Request;

interface BuscarComponentePorReclamacaoRepository
{
    public function buscarComponenteReclamacao(Request $request, $codreclamacao): ?array;
}