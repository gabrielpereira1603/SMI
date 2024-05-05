<?php

namespace app\Domain\Dao\Reclamacao;

use app\Domain\Service\Reclamacao\ExcluirReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class ExcluirReclamacaoRepositoryImpl implements ExcluirReclamacaoRepository
{

    public function excluirReclamacao(int $codreclamacao): bool
    {
        $database = new Database('reclamacao');
        $where = "codreclamacao = $codreclamacao";
        if ($database->delete($where)){
            return true;
        }
        return false;
    }
}