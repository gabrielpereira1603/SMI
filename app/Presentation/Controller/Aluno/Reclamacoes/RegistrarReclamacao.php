<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Application\UseCase\Reclamacao\CadastrarReclamacaoUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\FalhaCadastroReclamacao;
use app\Infrastructure\DataBase\Computador\AtualizaSituacaoComputadorDAO;
use app\Infrastructure\DataBase\Foto\InserirFotoReclamacaoDAO;
use app\Infrastructure\DataBase\Reclamacao\InserirReclamacaoRepositoryDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\InserirReclamacaoComponenteReclamacaoDAO;
use app\Presentation\Controller\Aluno\Page;

class RegistrarReclamacao extends Page
{
    private AtualizaSituacaoComputadorDAO $atualizaStatusRepository;
    private InserirReclamacaoRepositoryDAO $cadastraReclamacaoRepository;
    private InserirReclamacaoComponenteReclamacaoDAO $cadastrarComponenteReclamacao;

    public function __construct()
    {
        $this->atualizaStatusRepository = new AtualizaSituacaoComputadorDAO();
        $this->cadastraReclamacaoRepository = new InserirReclamacaoRepositoryDAO();
        $this->cadastrarComponenteReclamacao = new InserirReclamacaoComponenteReclamacaoDAO();
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

            $foto = $this->encodePhotos($_FILES);
            $useCase = new CadastrarReclamacaoUseCase(
                $this->cadastraReclamacaoRepository,
                $this->atualizaStatusRepository,
                $this->cadastrarComponenteReclamacao,
            );

            $useCase->cadastrarReclamacao($dadosReclamacao, $foto);
            $request->getRouter()->redirect('/aluno/home?success='. urlencode('Reclamação cadastrada com sucesso.'));
        } catch (FalhaCadastroReclamacao $e) {
            $request->getRouter()->redirect('/aluno/reclamacao/'.$codComputador.'?error=' . urlencode($e->getMessage()));
        }
    }

    private function encodePhotos($files): array
    {
        $encodedPhotos = [];

        if (!empty($files['foto-reclamacao']['tmp_name'][0])) {
            $numFiles = count($files['foto-reclamacao']['tmp_name']);

            for ($i = 0; $i < $numFiles; $i++) {
                $tmpName = $files['foto-reclamacao']['tmp_name'][$i];
                $content = file_get_contents($tmpName);
                // Codificar para base64
                $encodedContent = base64_encode($content);
                $encodedPhotos[] = $encodedContent;
            }
        }

        return $encodedPhotos;
    }

}