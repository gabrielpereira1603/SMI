<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\ExcluirReclamacaoUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAoExcluirReclamacaoException;
use app\Infrastructure\Dao\Computador\AtualizaStatusRepositoryImpl;
use app\Infrastructure\Dao\Foto\ExcluirFotoRepositoryImpl;
use app\Infrastructure\Dao\Reclamacao\ExcluirReclamacaoRepositoryImpl;
use app\Infrastructure\Dao\ReclamacaoComponente\ExcluirComponenteReclamacaoRepositoryImpl;
use app\Infrastructure\Http\Request;

class ExcluirReclamacao
{
    private ExcluirReclamacaoRepositoryImpl $excluirReclamacaoRepository;
    private ExcluirComponenteReclamacaoRepositoryImpl $excluirComponenteReclamacaoRepository;
    private AtualizaStatusRepositoryImpl $atualizaStatusRepository;
    private ExcluirFotoRepositoryImpl $excluirFotoRepository;

    public function __construct()
    {
        $this->excluirReclamacaoRepository = new ExcluirReclamacaoRepositoryImpl();
        $this->excluirComponenteReclamacaoRepository = new ExcluirComponenteReclamacaoRepositoryImpl();
        $this->atualizaStatusRepository = new AtualizaStatusRepositoryImpl();
        $this->excluirFotoRepository = new ExcluirFotoRepositoryImpl();
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