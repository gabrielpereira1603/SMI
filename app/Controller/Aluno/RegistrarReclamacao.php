<?php

namespace app\Controller\Aluno;

use app\Exceptions\RegistrarReclamacao\FalhaCadastroReclamacao;
use app\Model\Dao\Computador\AtualizaStatusRepositoryImpl;
use app\Model\Dao\Computador\ComputadorDao;
use app\Model\Dao\Foto\CadastrarFotoReclamacaoRepositoryImpl;
use app\Model\Dao\Reclamacao\CadastraReclamacaoRepositoryImpl;
use app\Model\Dao\ReclamacaoComponente\ReclamacaoComponenteRepositoryImpl;
use app\Model\UseCase\Reclamacao\CadastrarReclamacaoUseCase;
use app\Utils\Componentes\CheckBox\allCheckBoxComponentes;
use app\Utils\UploadFotos\GerenciarArquivosFotos;
use app\Model\Service\Computador\AtualizaStatusRepository;
use app\Utils\View;

class RegistrarReclamacao extends Page
{
    private AtualizaStatusRepositoryImpl $atualizaStatusRepository;
    private CadastraReclamacaoRepositoryImpl $cadastraReclamacaoRepository;
    private ReclamacaoComponenteRepositoryImpl $cadastrarComponenteReclamacao;
    private CadastrarFotoReclamacaoRepositoryImpl $cadastrarFotoReclamacao;

    public function __construct()
    {
        $this->atualizaStatusRepository = new AtualizaStatusRepositoryImpl();
        $this->cadastraReclamacaoRepository = new CadastraReclamacaoRepositoryImpl();
        $this->cadastrarComponenteReclamacao = new ReclamacaoComponenteRepositoryImpl();
        $this->cadastrarFotoReclamacao = new CadastrarFotoReclamacaoRepositoryImpl();
    }

    public static function getViewReclamacao($request,$codcomputador): string
    {
        $checkBoxComponente = allCheckBoxComponentes::getComponenteCheckBox($request);
        $obComputador = (new ComputadorDao())->getById($codcomputador);
        $content = View::render('aluno/modules/inserirReclamacao/index', [
            'itens' => $checkBoxComponente,
            'nav' => parent::getNav($request),
            'codcomputador' => $codcomputador,
            'codlaboratorio'=> $obComputador->getLaboratorio()->getCodlaboratorio(),
            'numerolaboratorio' => $obComputador->getLaboratorio()->getNumeroLaboratorio(),
            'patrimonio' => $obComputador->getPatrimonio(),
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPage('Reclamação',$content);
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