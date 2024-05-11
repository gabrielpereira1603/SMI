<?php

namespace app\Domain\Repository\Usuario;

use app\Infrastructure\Http\Request;

interface BuscarUsuarioPorLoginRepository
{
    public function buscarAluno(Request $request, $login);
}