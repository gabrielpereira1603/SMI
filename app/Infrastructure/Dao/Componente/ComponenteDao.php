<?php

namespace app\Infrastructure\Dao\Componente;

use app\Domain\Entity\Componente;
use WilliamCosta\DatabaseManager\Database;

class ComponenteDao
{
    public static function getAllComponentes(): array
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

    public static function editarComponente(int $codComponente, array $data)
    {
        if (empty($data)) {
            return false;
        }

        $whereClause = "codcomponente = $codComponente";

        $database = new Database('componente');
        $result = $database->update($whereClause, $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function cadastrarComponente(array $data)
    {
        if (empty($data)) {
            return null;
        }

        $database = new Database('componente');

        $id = $database->insert($data);

        return $id;
    }
}
