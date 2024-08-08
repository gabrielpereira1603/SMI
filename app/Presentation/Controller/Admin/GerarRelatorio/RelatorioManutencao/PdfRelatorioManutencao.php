<?php

namespace app\Presentation\Controller\Admin\GerarRelatorio\RelatorioManutencao;

use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\PDF\Manutencao\relatorioManutencaoPDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfRelatorioManutencao extends Page
{
    public static function gerarPdfRelatorioManutencao($request): void
    {
        $postVars = $request->getPostVars();
        // Verificar se algum campo está vazio
        if (empty($postVars['usuario']) || empty($postVars['laboratorio']) || empty($postVars['computador']) || empty($postVars['dataInicio']) || empty($postVars['dataFim'])) {
            $request->getRouter()->redirect('/admin/relatorio/manutencao?error=camposVazios');
            return;
        }

        $usuario = $postVars['usuario'];
        $laboratorio = $postVars['laboratorio'];
        $computador = $postVars['computador'];
        $dataInicio = $postVars['dataInicio'];
        $dataFim = $postVars['dataFim'];

        $ConteudoPDF = relatorioManutencaoPDF::gerarPDFemHTML($usuario, $laboratorio, $computador, $dataInicio, $dataFim);
        $options = new Options();
        $options->setDefaultFont('Courier');
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($ConteudoPDF);

        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("realtorio.pdf");
    }
}
