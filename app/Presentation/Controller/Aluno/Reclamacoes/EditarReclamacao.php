<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\EditarReclamacaoAbertaUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Infrastructure\DataBase\Reclamacao\AtualizaReclamacaoDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\EditarComponenteReclamacaoDAO;
use app\Infrastructure\Http\Request;

class EditarReclamacao
{
    private AtualizaReclamacaoDAO $atualizaReclamacaoRepository;
    private EditarComponenteReclamacaoDAO $atualizaComponenteReclamacaoRepository;

    public function __construct()
    {
        $this->atualizaReclamacaoRepository = new AtualizaReclamacaoDAO();
        $this->atualizaComponenteReclamacaoRepository = new EditarComponenteReclamacaoDAO();
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