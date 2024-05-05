<?php

namespace app\Infrastructure\Dao\ReclamacaoComponente;

use app\Domain\Entity\Componente;
use WilliamCosta\DatabaseManager\Database;

class ReclamacaoComponenteDao
{
    public function getComponenteReclamacao($codreclamacao): ?array
    {
        $where = "codreclamacao_fk = '$codreclamacao'";


        $join = 'INNER JOIN componente ON reclamacao_componente.codcomponente_fk = componente.codcomponente';
        $fields = 'componente.*';

        $results = (new Database('reclamacao_componente'))->select($where, null, null, null, $fields, $join)->fetchAll();
        if (empty($results)) {
            return null;
        }

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