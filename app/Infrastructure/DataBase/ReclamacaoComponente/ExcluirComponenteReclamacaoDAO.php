<?php

namespace app\Infrastructure\Dao\ReclamacaoComponente;

use app\Domain\Service\ReclamacaoComponente\ExcluirComponenteReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class ExcluirComponenteReclamacaoRepositoryImpl implements ExcluirComponenteReclamacaoRepository
{
    public function excluirComponenteReclamacao(int $codreclamacao): bool
    {
        $database = new Database('reclamacao_componente');
        $where = "codreclamacao_fk = $codreclamacao";
        if ($database->delete($where)){
            return true;
        }
        return false;
    }
}