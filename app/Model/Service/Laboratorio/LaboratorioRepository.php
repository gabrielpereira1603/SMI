<?php

namespace app\Model\Service\Laboratorio;

use app\Model\Entity\Laboratorio;

interface LaboratorioRepository
{
    public function getAllLaboratorios(): array;

    public function getById($codlaboratorio): ?Laboratorio;
}