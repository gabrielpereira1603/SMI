<?php

namespace app\Domain\Repository\Usuario;

interface GerarTokenRedefinirSenharRepository
{
    public function gerarToken(int $codusuario, array $dadosToken): bool;
}