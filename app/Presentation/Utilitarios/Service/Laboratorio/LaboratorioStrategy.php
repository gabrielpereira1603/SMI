<?php

namespace app\Utils\Service\Laboratorio;

interface LaboratorioStrategy
{
    public static function getLaboratorioItems($request): string;
}