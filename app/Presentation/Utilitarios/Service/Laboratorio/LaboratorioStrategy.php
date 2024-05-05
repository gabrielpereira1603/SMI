<?php

namespace app\Presentation\Utilitarios\Service\Laboratorio;

interface LaboratorioStrategy
{
    public static function getLaboratorioItems($request): string;
}