<?php

namespace app\Domain\Repository\Usuario;

use app\Domain\Entity\Usuario;

interface BuscarUsuarioPorEmailRepository
{
    public function buscarPorEmail(string $email): ?Usuario;
}