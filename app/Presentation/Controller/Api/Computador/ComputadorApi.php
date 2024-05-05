<?php

namespace app\Presentation\Controller\Api\Computador;

use app\Infrastructure\Dao\Computador\ComputadorDao;

class ComputadorApi
{
    public static function getComputadoresPorLab($request, $codlaboratorio): array
    {
        $results = (new ComputadorDao())->getComputadoresLaboratorio($codlaboratorio);

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