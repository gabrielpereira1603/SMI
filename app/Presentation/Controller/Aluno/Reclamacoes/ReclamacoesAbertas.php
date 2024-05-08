<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Infrastructure\DataBase\Reclamacao\BuscarReclamacaoPorUsuarioDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Aluno\Page;
use app\Presentation\Utilitarios\Componentes\Table\TableReclamacoesAbertas;
use app\Utils\View;

class ReclamacoesAbertas extends Page
{
    public static function getViewReclamacoesAbertas(Request $request): string
    {
        try {
            $reclamacoesAbertas = new TableReclamacoesAbertas(
                new BuscarReclamacaoPorUsuarioDAO(),
                new BuscarComponentePorReclamacaoDAO()
            );

            $tableReclamacao = $reclamacoesAbertas->getTableReclamacaoAberta($request);

            $content = View::render('aluno/modules/reclamacoesAbertas/index',[
                'itens'=> $tableReclamacao,
            ]);

            return parent::getPanel('Reclamações Abertas',$content,'reclamacoesAbertas');
        }catch (ReclamacoesNaoEncontradasExceptions $e){
            $request->getRouter()->redirect('/aluno/home?error=' . urlencode($e->getMessage()));
        }
    }
}