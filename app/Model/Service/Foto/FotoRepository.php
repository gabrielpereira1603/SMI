<?php

namespace app\Model\Service\Foto;

interface FotoRepository
{
    public function buscarPorReclamacao($codreclamacao): array;
}