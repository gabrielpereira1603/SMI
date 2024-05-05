<?php

namespace app\Utils\Service\Computador;
use WilliamCosta\DatabaseManager\Pagination;

interface ComputadorStrategy
{
    public static function getComputadorItems($request, $codlaboratorio, &$obPagination): string;
}