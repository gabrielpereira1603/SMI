<?php

namespace app\Infrastructure\Dao\ReclamacaoComponente;

use app\Domain\Service\ReclamacaoComponente\InserirComponenteReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class InserirReclamacaoComponenteReclamacaoRepositoryImpl implements InserirComponenteReclamacaoRepository
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