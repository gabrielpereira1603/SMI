<?php

namespace app\Model\Dao\ReclamacaoComponente;

use app\Model\Service\ReclamacaoComponente\AtualizaComponenteReclamacaoRepository;

class AtualizaComponenteReclamacaoRepositoryImpl implements AtualizaComponenteReclamacaoRepository
{
    public function atualizaComponenteReclamacao($codcomponente, $codreclamacao): bool
    {
        var_dump($codcomponente);
    }
}