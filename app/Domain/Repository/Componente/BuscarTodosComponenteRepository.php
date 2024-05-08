<?php

namespace app\Domain\Repository\Componente;

use app\Domain\Entity\Componente;
use app\Infrastructure\Http\Request;

interface BuscarTodosComponenteRepository
{
    public function buscarTodos(Request $request): bool|array;
}