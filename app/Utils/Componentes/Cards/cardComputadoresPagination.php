<?php

namespace app\Utils\Componentes\Cards;

use app\Controller\Admin\Page;
use app\Utils\Service\Computador\ComputadorStrategy;
use WilliamCosta\DatabaseManager\Pagination;
class cardComputadoresPagination extends Page
{
    public static function getComputadorItems($request,$codlaboratorio,&$obPagination,ComputadorStrategy $strategy): string
    {
        return $strategy->getComputadorItems($request,$codlaboratorio,$obPagination);
    }
}