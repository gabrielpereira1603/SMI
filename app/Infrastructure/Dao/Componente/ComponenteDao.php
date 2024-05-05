<?php

namespace app\Domain\Dao\Componente;

use app\Domain\Entity\Componente;
use WilliamCosta\DatabaseManager\Database;

class ComponenteDao
{
    public function getAllComponentes(): array
    {
        $results = (new Database('componente'))->select(null, null, null, null, '*', null)->fetchAll();

        $componentes = [];

        foreach ($results as $componenteData) {
            $componentes[] = new Componente(
                $componenteData['codcomponente'],
                $componenteData['nome_componente']
            );
        }

        return $componentes;
    }
}