<?php

namespace app\Presentation\Controller\Admin\GerarRelatorio;

use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectAdminUsuarios;
use app\Presentation\Utilitarios\Componentes\Select\SelectTodosLaboratorios;
use app\Presentation\Utilitarios\Componentes\Table\TableRelatorioManutencao;
use app\Utils\View;

class RelatorioManutencao extends Page
{
    public static function getViewRelatorioManutencao($request): string
    {
        $SelectUsersAdmin = SelectAdminUsuarios::getAdminUsers($request);
        $SelectTodosLaboratorios = SelectTodosLaboratorios::getLaboratorioItens($request);
        $content = View::render('admin/modules/relatorio/manutencao/index', [
            'user' => $SelectUsersAdmin,
            'laboratorio' => $SelectTodosLaboratorios
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPanel('Relatório Manutenção', $content, 'relatorio');
    }

    public static function getTableDataRelatorioManutencao($request): string
    {
        [
            'usuario' => $usuario,
            'laboratorio' => $laboratorio,
            'computador' => $computador,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim
        ] = $request->getPostVars();

        $tableData = TableRelatorioManutencao::buscarDadosRelatorioManutencao($usuario,$laboratorio,$computador,$dataInicio,$dataFim);

        $content .= View::render('admin/modules/relatorio/manutencao/table', [
            'usuario' => $usuario,
            'laboratorio' => $laboratorio,
            'computador' => $computador,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'table-itens'  => $tableData,
        ]);

        return parent::getPanel('Relatório Manutenção', $content, 'relatorio');
    }
}