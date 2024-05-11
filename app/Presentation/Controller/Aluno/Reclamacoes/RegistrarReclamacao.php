<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\CadastrarReclamacaoUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\FalhaCadastroReclamacao;
use app\Infrastructure\DataBase\Computador\AtualizaSituacaoComputadorDAO;
use app\Infrastructure\DataBase\Foto\InserirFotoReclamacaoDAO;
use app\Infrastructure\DataBase\Reclamacao\InserirReclamacaoRepositoryDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\InserirReclamacaoComponenteReclamacaoDAO;
use app\Presentation\Controller\Aluno\Page;
use app\Presentation\Utilitarios\UploadFotos\GerenciarArquivosFotos;

class RegistrarReclamacao extends Page
{
    private AtualizaSituacaoComputadorDAO $atualizaStatusRepository;
    private InserirReclamacaoRepositoryDAO $cadastraReclamacaoRepository;
    private InserirReclamacaoComponenteReclamacaoDAO $cadastrarComponenteReclamacao;
    private InserirFotoReclamacaoDAO $cadastrarFotoReclamacao;

    public function __construct()
    {
        $this->atualizaStatusRepository = new AtualizaSituacaoComputadorDAO();
        $this->cadastraReclamacaoRepository = new InserirReclamacaoRepositoryDAO();
        $this->cadastrarComponenteReclamacao = new InserirReclamacaoComponenteReclamacaoDAO();
        $this->cadastrarFotoReclamacao = new InserirFotoReclamacaoDAO();
    }

    public function setReclamacao($request, $codComputador): void
    {
        try {
            $dadosReclamacao = [
                'componente' => $componente,
                'descricao' => $descricao,
                'email' => $email,
                'codcomputador' => $codcomputador,
                'codlaboratorio' => $codlaboratorio
            ] = $request->getPostVars();

            $foto = GerenciarArquivosFotos::getUploadedPhotos($_FILES);

            $useCase = new CadastrarReclamacaoUseCase(
                $this->cadastraReclamacaoRepository,
                $this->atualizaStatusRepository,
                $this->cadastrarComponenteReclamacao,
                $this->cadastrarFotoReclamacao
            );

            $useCase->cadastrarReclamacao($dadosReclamacao, $foto);
            $request->getRouter()->redirect('/aluno/home?success='. urlencode('Reclamação cadastrada com sucesso.'));
        } catch (FalhaCadastroReclamacao $e) {
            $request->getRouter()->redirect('/aluno/reclamacao/'.$codComputador.'?error=' . urlencode($e->getMessage()));
        }
    }


}