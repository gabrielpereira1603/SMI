<?php

namespace app\Controller\Aluno;

use app\Http\Request;
use app\Model\Dao\Reclamacao\AtualizaReclamacaoRepositoryImpl;
use app\Model\Dao\ReclamacaoComponente\AtualizaComponenteReclamacaoRepositoryImpl;
use app\Model\UseCase\Reclamacao\EditarReclamacaoAbertaUseCase;
use app\Utils\Componentes\Table\TableReclamacoesAbertas;
use app\Utils\View;

class ReclamacoesAbertas extends Page
{
    private AtualizaReclamacaoRepositoryImpl $atualizaReclamacaoRepository;
    private AtualizaComponenteReclamacaoRepositoryImpl $atualizaComponenteReclamacaoRepository;

    public function __construct()
    {
        $this->atualizaReclamacaoRepository = new AtualizaReclamacaoRepositoryImpl();
        $this->atualizaComponenteReclamacaoRepository = new AtualizaComponenteReclamacaoRepositoryImpl();
    }

    public static function getViewReclamacoesAbertas($request): string
    {
        $reclamacoesAbertas = TableReclamacoesAbertas::getTableReclamacaoAberta($request);
        $content = View::render('aluno/modules/reclamacoesAbertas/index',[
            'itens'=> $reclamacoesAbertas,
        ]);

        return parent::getPanel('Reclamações Abertas',$content,'reclamacoesAbertas');
    }

    public function editarReclamacao(Request $request)
    {
        try {
            $dadosReclamacao = [
                'codreclamacao' => $codreclamacao,
                'componentesSelecionados' => $componentes,
            ] = $request->getPostVars();
            var_dump($dadosReclamacao);
            $useCase = new EditarReclamacaoAbertaUseCase(
                $this->atualizaReclamacaoRepository,
                $this->atualizaComponenteReclamacaoRepository
            );
exit();
        } catch (\Exception $e) {
        }

    }

}