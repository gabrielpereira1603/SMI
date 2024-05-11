<?php

namespace app\Domain\Repository\Usuario;

use app\Domain\Entity\Usuario;

interface ValidaDadosCriarUsuarioRepository
{
    public function buscarPorLogin(string $login): ?Usuario;
    public function buscarPorEmail(string $email): ?Usuario;
    public function buscarPorNome(string $nome): ?Usuario;
}