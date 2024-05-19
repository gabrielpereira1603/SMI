<?php

namespace app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao;

use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectAdminUsuarios;
use app\Presentation\Utilitarios\Componentes\Select\SelectTodosLaboratorios;
use app\Utils\View;

class ViewRelatorioManutencao extends Page
{
    public static function getView(Request $request)
    {
        $SelectUsersAdmin = SelectAdminUsuarios::getAdminUsers($request);
        
       // $SelectTodosLaboratorios = SelectTodosLaboratorios::getLaboratorioItens($request);
        $content = View::render('admin/modules/relatorio/manutencao/index', [
            'user' => $SelectUsersAdmin,
            'laboratorio' => $SelectTodosLaboratorios
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPanel('Relatório Manutenção', $content, 'relatorio');
    }
}