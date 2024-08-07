<?php

namespace app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao;

use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Table\TableRelatorioManutencao;
use app\Utils\View;

class DataRelatorioManutencao extends Page
{
    public static function getTableDataRelatorioManutencao(Request $request): string
    {
        [
            'usuario' => $usuario,
            'laboratorio' => $laboratorio,
            'computador' => $computador,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim
        ] = $request->getPostVars();

        $tableData = TableRelatorioManutencao::buscarDadosRelatorioManutencao($usuario,$laboratorio,$computador,$dataInicio,$dataFim);
        $content = '';
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