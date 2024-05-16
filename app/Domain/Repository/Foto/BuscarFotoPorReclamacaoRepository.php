<?php

namespace app\Domain\Repository\Foto;

use app\Domain\Entity\Foto;

interface BuscarFotoPorReclamacaoRepository
{
    public function buscarFoto($codreclamacao): ?Foto;
}