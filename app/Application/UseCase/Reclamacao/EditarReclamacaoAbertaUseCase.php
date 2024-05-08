<?php

namespace app\Application\UseCase\Reclamacao;

use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Domain\Repository\Reclamacao\AtualizaReclamacaoRepository;
use app\Domain\Repository\ReclamacaoComponente\EditarComponenteReclamacaoRepository;

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
        $componentesSelecionados = explode(",", $dadosReclamacao['componentesSelecionados']);

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