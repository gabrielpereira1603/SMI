<?php

namespace app\Domain\Service\Foto;

interface ExcluirFotoRepository
{
    public function exlcuirFoto(int $codreclamacao): bool;
}