<?php

namespace app\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\ExcluirReclamacaoUseCase;
use app\Http\Request;
use app\Model\Dao\Computador\AtualizaStatusRepositoryImpl;
use app\Model\Dao\Foto\ExcluirFotoRepositoryImpl;
use app\Model\Dao\Reclamacao\ExcluirReclamacaoRepositoryImpl;
use app\Model\Dao\ReclamacaoComponente\ExcluirComponenteReclamacaoRepositoryImpl;

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
        $dadosReclamacao = $request->getPostVars();

        $useCase = new ExcluirReclamacaoUseCase(
            $this->excluirReclamacaoRepository,
            $this->excluirComponenteReclamacaoRepository,
            $this->atualizaStatusRepository,
            $this->excluirFotoRepository
        );

        $useCase->excluirReclamacao($dadosReclamacao);
    }
}