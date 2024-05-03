<?php

namespace app\Model\Dao\ReclamacaoComponente;

use app\Model\Service\ReclamacaoComponente\InserirComponenteRepository;
use WilliamCosta\DatabaseManager\Database;

class ReclamacaoComponenteRepositoryImpl implements InserirComponenteRepository
{

    public function inserirComponente(int $codreclamacao, int $codComponente): bool
    {
        $database = new Database('reclamacao_componente');

        // Realize a inserção do componente na tabela reclamacao_componente
        $result = $database->insert([
            'codreclamacao_fk' => $codreclamacao,
            'codcomponente_fk' => $codComponente
        ]);

        return true;
    }

}