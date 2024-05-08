<?php

namespace app\Infrastructure\DataBase\ReclamacaoComponente;

use app\Domain\Entity\Componente;
use app\Domain\Repository\ReclamacaoComponente\BuscarComponentePorReclamacaoRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarComponentePorReclamacaoDAO implements BuscarComponentePorReclamacaoRepository
{
    public function buscarComponenteReclamacao(Request $request, $codreclamacao): ?array
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