<?php

namespace app\Utils\Componentes\Cards;

use app\Model\Dao\Computador\ComputadorDao;
use app\Model\Dao\Laboratorio\LaboratorioDao;
use app\Utils\Service\Laboratorio\LaboratorioStrategy;
use app\Utils\View;

class cardLaboratorios
{
    public static function getLaboratorioItems($request, LaboratorioStrategy $strategy): string
    {
        return $strategy->getLaboratorioItems($request);
    }

}