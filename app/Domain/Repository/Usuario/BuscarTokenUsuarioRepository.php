<?php

namespace app\Domain\Repository\Usuario;

use app\Domain\Entity\Usuario;

interface BuscarTokenUsuarioRepository
{
    public function buscarToken(string $token): ?Usuario;
}