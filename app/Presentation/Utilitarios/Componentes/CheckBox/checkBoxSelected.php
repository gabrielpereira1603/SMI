<?php

namespace app\Presentation\Utilitarios\Componentes\CheckBox;

use app\Application\UseCase\Reclamacao\BuscarReclamacaoPorComputadorUseCase;
use app\Application\UseCase\ReclamacaoComponente\BuscarComponentePorReclamacaoUseCase;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class checkBoxSelected extends Page
{
    private BuscarComponentePorReclamacaoDAO $buscarComponentePorReclamacaoDAO;

    public function __construct(BuscarComponentePorReclamacaoDAO $buscarComponentePorReclamacaoDAO)
    {
        $this->buscarComponentePorReclamacaoDAO = $buscarComponentePorReclamacaoDAO;
    }

    public function getComponentesView(Request $request, $codreclamacao): string
    {
        $results = (new BuscarComponentePorReclamacaoUseCase($this->buscarComponentePorReclamacaoDAO))->execute($request,$codreclamacao);

        $content = '';
        foreach ($results as $obComponente) {
            $content .= View::render('admin/componente/item', [
                'nome_componente'   => $obComponente->getNomeComponente(),
            ]);

        }
        return parent::getPage('Manutenção', $content);
    }
}