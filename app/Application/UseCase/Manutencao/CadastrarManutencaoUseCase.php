<?php

namespace app\Application\UseCase\Manutencao;

use app\Domain\Exceptions\Computador\ErrorAoAlterarSituacaoComputador;
use app\Domain\Exceptions\Manutencao\ErrorCadastrarManutencaoException;
use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Domain\Repository\Computador\AtualizaSituacaoRepository;
use app\Domain\Repository\Manutencao\CadastrarManutencaoRepository;
use app\Domain\Repository\Reclamacao\AtualizaReclamacaoRepository;
use app\Infrastructure\Http\Request;

class CadastrarManutencaoUseCase
{
    private CadastrarManutencaoRepository $cadastrarManutencaoRepository;
    private AtualizaSituacaoRepository  $atualizaSituacaoRepository;
    private AtualizaReclamacaoRepository $atualizaReclamacaoRepository;

    public function __construct(CadastrarManutencaoRepository $cadastrarManutencaoRepository, AtualizaSituacaoRepository $atualizaSituacaoRepository, AtualizaReclamacaoRepository $atualizaReclamacaoRepository)
    {
        $this->cadastrarManutencaoRepository = $cadastrarManutencaoRepository;
        $this->atualizaSituacaoRepository = $atualizaSituacaoRepository;
        $this->atualizaReclamacaoRepository = $atualizaReclamacaoRepository;
    }

    public function execute(Request $request, array $postVars, $codcomputador): bool
    {
        $userData = $_SESSION['admin']['usuario'];
        $codUsuario = $userData['codusuario'];
        $lastIdManutencao = $this->cadastrarManutencaoRepository->cadastrarManutencao($postVars['descricao'],$codUsuario, $postVars['codreclamacao']);

        if ($lastIdManutencao === false) {
            throw new ErrorCadastrarManutencaoException("Não foi possível cadastrar à manutenção");
        }

        if(!$this->atualizaSituacaoRepository->atualizaStatus($codcomputador,['codsituacao_fk' => 1])){
            throw new ErrorAoAlterarSituacaoComputador("Error ao alterar a situação do computador!");
        }

        if(!$this->atualizaReclamacaoRepository->atualizaReclamacao($postVars['codreclamacao'],['status' => 'Concluida'])){
            throw new ErrorAtualizarReclamacaoException("Error ao atualizar a reclamação");
        }

        return true;
    }
}