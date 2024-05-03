<?php

namespace app\Utils\Service\Laboratorio;

use app\Model\Dao\Computador\ComputadorDao;
use app\Model\Dao\Laboratorio\LaboratorioDao;
use app\Utils\View;

class AdminLaboratorioStrategy implements LaboratorioStrategy
{
    public static function getLaboratorioItems($request): string
    {
        $itens = '';

        $obLaboratorios = new LaboratorioDao();
        $laboratorios = $obLaboratorios->getAllLaboratorios();

        foreach ($laboratorios as $laboratorio) {
            $codLaboratorio = $laboratorio->getCodLaboratorio();
            $numeroLaboratorio = $laboratorio->getNumeroLaboratorio();

            $computadores = (new ComputadorDao())->getComputadoresLaboratorio($codLaboratorio);

            $quantidadeTotalComputadores = count($computadores);

            $computadoresHTML = '';

            $disponiveis = 0;
            $indisponiveis = 0;
            $emManutencao = 0;

            foreach ($computadores as $computador) {
                switch ($computador->getSituacao()->getCodSituacao()) {
                    case 1:
                        $disponiveis++;
                        break;
                    case 2:
                        $emManutencao++;
                        break;
                    case 3:
                        $indisponiveis++;
                        break;
                    default:
                        // Situação inválida
                        break;
                }
            }
            $itens .= View::render('admin/laboratorio/item', [
                'codlaboratorio' => $codLaboratorio,
                'numerolaboratorio' => $numeroLaboratorio,
                'quantidade_disponiveis' => $disponiveis,
                'quantidade_indisponiveis' => $indisponiveis,
                'quantidade_em_manutencao' => $emManutencao,
                'quantidade_total_computadores' => $quantidadeTotalComputadores
            ]);
        }
        return $itens;
    }
}