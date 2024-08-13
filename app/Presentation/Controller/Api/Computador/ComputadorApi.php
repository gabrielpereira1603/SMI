<?php

namespace app\Presentation\Controller\Api\Computador;

use app\Application\UseCase\Computador\BuscarComputadoresPorLaboratorioUseCase;
use app\Infrastructure\Dao\Computador\ComputadorDao;
use app\Infrastructure\DataBase\Computador\ComputadoresPorLaboratorioDAO;

class ComputadorApi
{
    public static function getComputadoresPorLab($request, $codlaboratorio): array
    {
        $results = (new BuscarComputadoresPorLaboratorioUseCase(new ComputadoresPorLaboratorioDAO()))->execute($request,$codlaboratorio);

        $computadores = [];

        foreach ($results as $computador) {
            $computadores[] = [
                'codcomputador' => $computador->getCodcomputador(),
                'patrimonio' => $computador->getPatrimonio(),
                'tiposituacao' => $computador->getSituacao()->getTipoSituacao(),
                'numerolaboratorio' => $computador->getLaboratorio()->getNumeroLaboratorio(),
            ];
        }

        return $computadores;
    }

}