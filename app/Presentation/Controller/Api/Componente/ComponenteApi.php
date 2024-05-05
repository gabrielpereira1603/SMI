<?php

namespace app\Presentation\Controller\Api\Componente;

use app\Infrastructure\Dao\Componente\ComponenteDao;
use app\Infrastructure\Dao\ReclamacaoComponente\ReclamacaoComponenteDao;

class ComponenteApi
{
    public static function getAllComponentes($request): array
    {
        $componenteDao = new ComponenteDao();

        return $componenteDao->getAllComponentes();
    }

    public static function getComponentesReclamacao($request,$codreclamacao): array
    {
        $reclamacaoComponenteDao = new ReclamacaoComponenteDao();

        return $reclamacaoComponenteDao->getComponenteReclamacao($codreclamacao);
    }
}