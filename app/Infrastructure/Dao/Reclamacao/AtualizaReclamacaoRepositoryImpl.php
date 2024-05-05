<?php

namespace app\Infrastructure\Dao\Reclamacao;

use app\Domain\Service\Reclamacao\AtualizaReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class AtualizaReclamacaoRepositoryImpl implements AtualizaReclamacaoRepository
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