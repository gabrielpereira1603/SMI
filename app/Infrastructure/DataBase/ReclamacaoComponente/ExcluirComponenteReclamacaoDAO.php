<?php

namespace app\Infrastructure\DataBase\ReclamacaoComponente;

use app\Domain\Repository\ReclamacaoComponente\ExcluirComponenteReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class ExcluirComponenteReclamacaoDAO implements ExcluirComponenteReclamacaoRepository
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