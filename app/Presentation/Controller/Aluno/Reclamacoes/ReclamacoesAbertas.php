<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;

use app\Presentation\Controller\Aluno\Page;
use app\Presentation\Utilitarios\Componentes\Table\TableReclamacoesAbertas;
use app\Utils\View;

class ReclamacoesAbertas extends Page
{
    public static function getViewReclamacoesAbertas($request): string
    {
        $reclamacoesAbertas = TableReclamacoesAbertas::getTableReclamacaoAberta($request);
        $content = View::render('aluno/modules/reclamacoesAbertas/index',[
            'itens'=> $reclamacoesAbertas,
        ]);

        return parent::getPanel('Reclamações Abertas',$content,'reclamacoesAbertas');
    }

}