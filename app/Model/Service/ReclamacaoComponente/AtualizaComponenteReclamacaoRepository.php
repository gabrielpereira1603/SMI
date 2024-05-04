<?php

namespace app\Model\Service\ReclamacaoComponente;

interface AtualizaComponenteReclamacaoRepository
{
    public function atualizaComponenteReclamacao($codcomponente,$codreclamacao): bool;
}