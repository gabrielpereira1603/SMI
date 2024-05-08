<?php

namespace app\Domain\Repository\Foto;

interface ExcluirFotoRepository
{
    public function exlcuirFoto(int $codreclamacao): bool;
}