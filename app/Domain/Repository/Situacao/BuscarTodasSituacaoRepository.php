<?php

namespace app\Domain\Repository\Situacao;

use app\Domain\Entity\NivelAcesso;
use app\Infrastructure\Http\Request;

interface BuscarTodasSituacaoRepository
{
    public function buscarTodos(Request $request): ?array;
}