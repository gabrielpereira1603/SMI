<?php

namespace app\Domain\Repository\Reclamacao;

use app\Domain\Entity\Reclamacao;

interface BuscarReclamacaoPorIdRepository
{
    public function buscarPorId($coreclamacao): ?Reclamacao;
}