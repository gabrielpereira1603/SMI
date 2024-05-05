<?php

namespace app\Presentation\Utilitarios\Componentes\Cards;

use app\Presentation\Utilitarios\Service\Laboratorio\LaboratorioStrategy;

class cardLaboratorios
{
    public static function getLaboratorioItems($request, LaboratorioStrategy $strategy): string
    {
        return $strategy->getLaboratorioItems($request);
    }

}