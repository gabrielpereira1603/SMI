<?php

namespace app\Controller\Api\Componente;

use app\Model\Dao\Componente\ComponenteDao;
use app\Model\Dao\ReclamacaoComponente\ReclamacaoComponenteDao;

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