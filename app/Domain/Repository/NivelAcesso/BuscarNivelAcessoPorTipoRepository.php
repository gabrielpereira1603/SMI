<?php

namespace app\Domain\Repository\NivelAcesso;

use app\Domain\Entity\NivelAcesso;
use app\Infrastructure\Http\Request;

interface BuscarNivelAcessoPorTipoRepository
{
    public function buscarPorTipo(Request $request, $tipoAcesso): ?NivelAcesso;
}