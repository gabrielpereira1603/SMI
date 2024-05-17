<?php

namespace app\Domain\Repository\Reclamacao;

use app\Domain\Entity\Reclamacao;

interface BuscarReclamacaoPorComputadorRepository
{
    public function buscarReclamacao($codcomputador,$statusReclamacao): ?Reclamacao;
}