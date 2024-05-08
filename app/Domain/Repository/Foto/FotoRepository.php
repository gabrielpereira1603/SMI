<?php

namespace app\Domain\Service\Foto;

interface FotoRepository
{
    public function buscarPorReclamacao($codreclamacao): array;
}