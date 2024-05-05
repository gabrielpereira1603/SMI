<?php

namespace app\Presentation\Utilitarios\Componentes\Cards;

use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Service\Computador\ComputadorStrategy;

class cardComputadoresPagination extends Page
{
    public static function getComputadorItems($request,$codlaboratorio,&$obPagination,ComputadorStrategy $strategy): string
    {
        return $strategy->getComputadorItems($request,$codlaboratorio,$obPagination);
    }
}