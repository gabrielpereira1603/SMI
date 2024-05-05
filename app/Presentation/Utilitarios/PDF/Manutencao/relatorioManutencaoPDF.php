<?php

namespace app\Utils\PDF\Manutencao;

use app\Utils\Componentes\Table\TableRelatorioManutencao;
use app\Utils\View;

class relatorioManutencaoPDF
{
    public static function gerarPDFemHTML($usuario,$laboratorio,$computador,$dataInicio,$dataFim): string
    {
        $tableData = TableRelatorioManutencao::buscarDadosRelatorioManutencao($usuario,$laboratorio,$computador,$dataInicio,$dataFim);

        $content .= View::render('admin/modules/relatorio/manutencao/PDFrelatorio', [
            'usuario' => $usuario,
            'laboratorio' => $laboratorio,
            'computador' => $computador,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'itens' => $tableData
        ]);

        return $content;
    }
}