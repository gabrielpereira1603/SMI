<?php

namespace app\Presentation\Controller\Api\Componente;

use app\Infrastructure\Dao\Componente\ComponenteDao;

class ComponenteApi
{
    public static function getAllComponentes($request): array
    {
        $componenteDao = new ComponenteDao();

        return $componenteDao->getAllComponentes();
    }

}