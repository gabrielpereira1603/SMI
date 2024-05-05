<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\EditarReclamacaoAbertaUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Infrastructure\Dao\Reclamacao\AtualizaReclamacaoRepositoryImpl;
use app\Infrastructure\Dao\ReclamacaoComponente\EditarComponenteReclamacaoRepositoryImpl;
use app\Infrastructure\Http\Request;

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