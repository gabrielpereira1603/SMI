<?php

namespace app\Domain\Repository\Usuario;

use app\Domain\Entity\Usuario;
use app\Infrastructure\Http\Request;

interface CriarUsuarioRepository
{
    public function criarUsuario(Request $request, array $usuario): bool;
}