<?php

namespace app\Domain\Service\Computador;

interface ComputadorRepository
{
    public function getComputadoresLaboratorio($laboratorio): array;

    public function updateComputador(int $codcomputador, array $data): bool;

}