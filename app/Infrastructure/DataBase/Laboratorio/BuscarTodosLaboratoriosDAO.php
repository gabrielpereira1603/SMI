<?php

namespace app\Infrastructure\DataBase\Laboratorio;

use app\Domain\Entity\Laboratorio;
use app\Domain\Repository\Laboratorio\BuscarTodosLaboratoriosRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarTodosLaboratoriosDAO implements BuscarTodosLaboratoriosRepository
{
    public function buscarTodosLaboratorios(Request $request): array
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
}