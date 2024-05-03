<?php

namespace app\Model\Service\Computador;

use app\Model\Entity\Computador;

interface ComputadorRepository
{
    public function getComputadoresLaboratorio($laboratorio): array;

    public function updateComputador(int $codcomputador, array $data): bool;

}