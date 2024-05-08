<?php

namespace app\Domain\Repository\Reclamacao;

use app\Domain\Entity\Reclamacao;
use app\Infrastructure\Http\Request;

interface BuscarReclamacaoPorAlunoRepository
{
    public function buscarReclamacao(Request $request, $codusuario): ?array;
}