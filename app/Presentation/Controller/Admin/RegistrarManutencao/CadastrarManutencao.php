<?php

namespace app\Presentation\Controller\Admin\RegistrarManutencao;

use app\Application\UseCase\Manutencao\CadastrarManutencaoUseCase;
use app\Application\UseCase\Reclamacao\BuscarReclamacaoPorIdUseCase;
use app\Domain\Exceptions\Computador\ErrorAoAlterarSituacaoComputador;
use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Domain\Exceptions\Manutencao\ErrorCadastrarManutencaoException;
use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAtualizarReclamacaoException;
use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Infrastructure\DataBase\Reclamacao\BuscarReclamacaoPorIdDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Utilitarios\Email\CadastrarManutencao\CadastrarManutencaoEmail;

class CadastrarManutencao
{
    private CadastrarManutencaoUseCase $cadastrarManutencaoUseCase;
    private CadastrarManutencaoEmail $cadastrarManutencaoEmail;

    public function __construct(CadastrarManutencaoUseCase $cadastrarManutencaoUseCase)
    {
        $this->cadastrarManutencaoUseCase = $cadastrarManutencaoUseCase;
        $this->cadastrarManutencaoEmail = new CadastrarManutencaoEmail();
    }

    public function cadastrarManutencao(Request $request,$codcomputador)
    {
        try {
            $postVars = $request->getPostVars();

            $this->cadastrarManutencaoUseCase->execute($request,$postVars,$codcomputador);

            $obReclamacao = (new BuscarReclamacaoPorIdUseCase(new BuscarReclamacaoPorIdDAO()))->execute($request,$postVars['codreclamacao']);

            $this->cadastrarManutencaoEmail->enviarManutencaoRealizada($obReclamacao->getUsuario()->getEmailUsuario(),$obReclamacao->getUsuario()->getNomeUsuario());

            $request->getRouter()->redirect('/admin?success='. urlencode('Manutencao cadastrada com sucesso!'));
        }catch (ErrorCadastrarManutencaoException | ErrorAoAlterarSituacaoComputador | ErrorAtualizarReclamacaoException | ErroAoEnviarEmailException | ReclamacoesNaoEncontradasExceptions $e){
            $request->getRouter()->redirect('/admin/manutencao/'.$codComputador.'?error=' . urlencode($e->getMessage()));
        }
    }
}