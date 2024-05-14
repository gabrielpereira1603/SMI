<?php

namespace app\Domain\Repository\Usuario;

interface RedefinirSenhaUsuarioRepository
{
    public function redefinirSenha(int $codusuario, array $dados): bool;
}