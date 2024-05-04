<?php

namespace app\Model\UseCase\Reclamacao;

use app\Model\Service\Reclamacao\AtualizaReclamacaoRepository;
use app\Model\Service\ReclamacaoComponente\AtualizaComponenteReclamacaoRepository;

class EditarReclamacaoAbertaUseCase
{
    private AtualizaReclamacaoRepository $atualizaReclamacaoRepository;
    private AtualizaComponenteReclamacaoRepository $atualizaComponentesReclamacaoRepository;

    public function __construct
    (

    )
    {
        $this->atualizaReclamacaoRepository = $atualizaReclamacaoRepository;
        $this->atualizaComponentesReclamacaoRepository = $atualizaComponentesReclamacaoRepository;
    }
}