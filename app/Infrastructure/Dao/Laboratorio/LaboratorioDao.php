<?php

namespace app\Infrastructure\Dao\Laboratorio;

use app\Domain\Entity\Laboratorio;
use app\Domain\Service\Laboratorio\LaboratorioRepository;
use WilliamCosta\DatabaseManager\Database;

class LaboratorioDao implements LaboratorioRepository
{
    public function getAllLaboratorios(): array
    {
        $results = (new Database('laboratorio'))->select(null, null, null, null, '*', null)->fetchAll();

        $laboratorios = [];

        foreach ($results as $laboratorioData) {
            $laboratorios[] = new Laboratorio(
                $laboratorioData['codlaboratorio'],
                $laboratorioData['numerolaboratorio']
            );
        }


        return $laboratorios;
    }

    public function getById($codlaboratorio): ?Laboratorio
    {
        $where = "laboratorio.codlaboratorio = '$codlaboratorio'";

        $result = (new Database('laboratorio'))->select($where, null, null, null, '*', null)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $laboratorioData = $result[0];

        return new Laboratorio(
            $laboratorioData['codlaboratorio'],
            $laboratorioData['numerolaboratorio']
        );
    }
}