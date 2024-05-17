<?php

namespace app\Infrastructure\DataBase\Reclamacao;

use app\Domain\Repository\Reclamacao\ExcluirReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class ExcluirReclamacaoDAO implements ExcluirReclamacaoRepository
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