<?php

namespace app\Domain\Service\Laboratorio;

use app\Domain\Entity\Laboratorio;

interface LaboratorioRepository
{
    public function getAllLaboratorios(): array;

    public function getById($codlaboratorio): ?Laboratorio;
}