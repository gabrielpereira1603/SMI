<?php

namespace app\Infrastructure\DataBase\Reclamacao;

use app\Domain\Repository\Reclamacao\AtualizaReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class AtualizaReclamacaoDAO implements AtualizaReclamacaoRepository
{

    public function atualizaReclamacao(int $codreclamacao, array $valoresParaAlterar): bool
    {
        if (empty($valoresParaAlterar)) {
            return false;
        }
        $whereClause = "codreclamacao = $codreclamacao";

        $database = new Database('reclamacao');
        $result = $database->update($whereClause, $valoresParaAlterar);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}