<?php

namespace app\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\EditarReclamacaoAbertaUseCase;
use app\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Http\Request;
use app\Model\Dao\Reclamacao\AtualizaReclamacaoRepositoryImpl;
use app\Model\Dao\ReclamacaoComponente\EditarComponenteReclamacaoRepositoryImpl;

class EditarReclamacao
{
    private AtualizaReclamacaoRepositoryImpl $atualizaReclamacaoRepository;
    private EditarComponenteReclamacaoRepositoryImpl $atualizaComponenteReclamacaoRepository;

    public function __construct()
    {
        $this->atualizaReclamacaoRepository = new AtualizaReclamacaoRepositoryImpl();
        $this->atualizaComponenteReclamacaoRepository = new EditarComponenteReclamacaoRepositoryImpl();
    }

    public function editarReclamacao(Request $request): void
    {
        try {
            $dadosReclamacao = $request->getPostVars();

            $useCase = new EditarReclamacaoAbertaUseCase(
                $this->atualizaReclamacaoRepository,
                $this->atualizaComponenteReclamacaoRepository
            );
            $useCase->editarReclamacao($dadosReclamacao);
            $request->getRouter()->redirect('/aluno/reclamacoesAbertas?success='. urlencode('Reclamação atualizada com sucesso.'));
        } catch (ErrorAtualizarReclamacaoException $e) {
            $request->getRouter()->redirect('/aluno/reclamacoesAbertas?error=' . urlencode($e->getMessage()));
        }
    }
}