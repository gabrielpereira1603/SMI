<?php

namespace app\Infrastructure\DataBase\Laboratorio;

use app\Domain\Entity\Laboratorio;
use app\Domain\Repository\Laboratorio\BuscarLaboratorioPorId;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarLaboratorioPorIdDAO implements BuscarLaboratorioPorId
{

    public function buscarPorId(Request $request, int $codlaboratorio): ?Laboratorio
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