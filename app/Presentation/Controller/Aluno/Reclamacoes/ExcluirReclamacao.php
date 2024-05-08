<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\ExcluirReclamacaoUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAoExcluirReclamacaoException;
use app\Infrastructure\DataBase\Computador\AtualizaSituacaoComputadorDAO;
use app\Infrastructure\DataBase\Foto\ExcluirFotoPorReclamacaoDAO;
use app\Infrastructure\DataBase\Reclamacao\ExcluirReclamacaoDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\ExcluirComponenteReclamacaoDAO;
use app\Infrastructure\Http\Request;

class ExcluirReclamacao
{
    private ExcluirReclamacaoDAO $excluirReclamacaoRepository;
    private ExcluirComponenteReclamacaoDAO $excluirComponenteReclamacaoRepository;
    private AtualizaSituacaoComputadorDAO $atualizaStatusRepository;
    private ExcluirFotoPorReclamacaoDAO $excluirFotoRepository;

    public function __construct()
    {
        $this->excluirReclamacaoRepository = new ExcluirReclamacaoDAO();
        $this->excluirComponenteReclamacaoRepository = new ExcluirComponenteReclamacaoDAO();
        $this->atualizaStatusRepository = new AtualizaSituacaoComputadorDAO();
        $this->excluirFotoRepository = new ExcluirFotoPorReclamacaoDAO();
    }
    public function excluirReclamacao(Request $request): void
    {
        try {
            $dadosReclamacao = $request->getPostVars();

            $useCase = new ExcluirReclamacaoUseCase(
                $this->excluirReclamacaoRepository,
                $this->excluirComponenteReclamacaoRepository,
                $this->atualizaStatusRepository,
                $this->excluirFotoRepository
            );

            $useCase->excluirReclamacao($dadosReclamacao);
            $request->getRouter()->redirect('/aluno/reclamacoesAbertas?success='. urlencode('Reclamação excluida com sucesso.'));
        } catch (ErrorAoExcluirReclamacaoException $e){
            $request->getRouter()->redirect('/aluno/reclamacoesAbertas?error=' . urlencode($e->getMessage()));
        }

    }
}