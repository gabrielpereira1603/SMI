<?php

namespace app\Model\UseCase\Reclamacao;

use app\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Model\Service\Reclamacao\AtualizaReclamacaoRepository;
use app\Model\Service\ReclamacaoComponente\EditarComponenteReclamacaoRepository;

class EditarReclamacaoAbertaUseCase
{
    private AtualizaReclamacaoRepository $atualizaReclamacaoRepository;
    private EditarComponenteReclamacaoRepository $atualizaComponentesReclamacaoRepository;

    public function __construct
    (
        AtualizaReclamacaoRepository $atualizaReclamacaoRepository,
        EditarComponenteReclamacaoRepository $atualizaComponentesReclamacaoRepository
    )
    {
        $this->atualizaReclamacaoRepository = $atualizaReclamacaoRepository;
        $this->atualizaComponentesReclamacaoRepository = $atualizaComponentesReclamacaoRepository;
    }

    public function editarReclamacao(array $dadosReclamacao): void
    {
        $codReclamacao = $dadosReclamacao['codreclamacao'];
        $descricao = $dadosReclamacao['editarDescricao'];
        $componentesSelecionados = explode(",", $dadosReclamacao['componentesSelecionados']); // Convert string to array

        if (!$this->atualizaReclamacaoRepository->atualizaReclamacao($codReclamacao, ['descricao' => $descricao])){
            throw new ErrorAtualizarReclamacaoException("Error ao atualizar a reclamação.");
        }

        $this->atualizaComponentesReclamacaoRepository->removerComponenteReclamacao($codReclamacao);

        foreach ($componentesSelecionados as $componente) {
            if (!$this->atualizaComponentesReclamacaoRepository->inserirComponenteReclamacao($codReclamacao, (int)$componente)){
                throw new ErrorAtualizarReclamacaoException("Error ao atualizar os componentes da reclamação.");
            }
        }

    }
}