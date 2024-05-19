<?php

namespace app\Domain\Repository\Usuario;

use app\Infrastructure\Http\Request;

interface BuscarTodosUsuarioAdminRepository
{
    public function buscarTodos(Request $request): ?array;
}