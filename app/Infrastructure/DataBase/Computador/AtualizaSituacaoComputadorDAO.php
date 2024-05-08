<?php

namespace app\Infrastructure\DataBase\Computador;

use app\Domain\Repository\Computador\AtualizaStatusRepository;
use WilliamCosta\DatabaseManager\Database;

class AtualizaSituacaoComputadorDAO implements AtualizaStatusRepository
{
    public function atualizaStatus(int $codcomputador, array $valoresParaAlterar): bool
    {
        if (empty($valoresParaAlterar)) {
            return false;
        }

        $whereClause = "codcomputador = $codcomputador";

        $database = new Database('computador');
        $result = $database->update($whereClause, $valoresParaAlterar);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}