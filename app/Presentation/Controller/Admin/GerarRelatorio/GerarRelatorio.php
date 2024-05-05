<?php

namespace app\Controller\Admin\GerarRelatorio;

use app\Controller\Admin\Page;
use app\Utils\View;

class GerarRelatorio extends Page
{
    public static function getRelatorio($request): string
    {
        //CONTEUDO DA PAGINA DE RECLAMACAO
        $content = View::render('admin/modules/relatorio/index', [

        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPanel('Relatório', $content, 'relatorio');
    }
}