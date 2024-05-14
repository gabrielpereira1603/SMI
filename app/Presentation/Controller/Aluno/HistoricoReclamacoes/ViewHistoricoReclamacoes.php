<?php

namespace app\Presentation\Controller\Aluno\HistoricoReclamacoes;

use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Infrastructure\DataBase\Reclamacao\BuscarReclamacaoPorUsuarioDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Aluno\Page;
use app\Presentation\Utilitarios\Componentes\Table\TableHistoricoReclamacoes;
use app\Utils\View;

class ViewHistoricoReclamacoes extends Page
{
    public static function getViewReclamacoesAbertas(Request $request): string
    {
        try {
            $historicoReclamacao = new TableHistoricoReclamacoes(
                new BuscarReclamacaoPorUsuarioDAO(),
                new BuscarComponentePorReclamacaoDAO()
            );

            $tableReclamacao = $historicoReclamacao->getTableHistoricoReclamacao($request);

            $content = View::render('aluno/modules/historicoReclamacao/index',[
                'itens'=> $tableReclamacao,
            ]);

            return parent::getPanel('Histórico Reclamações',$content,'historicoReclamacao');
        }catch (ReclamacoesNaoEncontradasExceptions $e){
            $request->getRouter()->redirect('/aluno/home?error=' . urlencode($e->getMessage()));
        }
    }
}