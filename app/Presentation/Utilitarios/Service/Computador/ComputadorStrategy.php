<?php

namespace app\Presentation\Utilitarios\Service\Computador;

interface
ComputadorStrategy
{
    public static function getComputadorItems($request, $codlaboratorio, &$obPagination): string;
}