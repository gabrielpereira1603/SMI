<?php

namespace app\Domain\Repository\Foto;

interface FotoRepository
{
    public function buscarPorReclamacao($codreclamacao): array;
}