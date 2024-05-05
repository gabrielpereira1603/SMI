<?php

namespace app\Domain\Dao\ReclamacaoComponente;

use app\Domain\Service\ReclamacaoComponente\EditarComponenteReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class EditarComponenteReclamacaoRepositoryImpl implements EditarComponenteReclamacaoRepository
{
    public function removerComponenteReclamacao(int $codreclamacao): bool
    {
       $database = new Database('reclamacao_componente');
       $where = "codreclamacao_fk = $codreclamacao";
       if ($database->delete($where)){
           return true;
       }
       return false;
    }

    public function inserirComponenteReclamacao(int $codreclamacao, int $componente): bool
    {

        $database = new Database('reclamacao_componente');

        $result = $database->insert([
            'codreclamacao_fk' => $codreclamacao,
            'codcomponente_fk' => $componente
        ]);

        return true;
    }
}