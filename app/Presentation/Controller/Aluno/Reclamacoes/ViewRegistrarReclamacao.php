<?php

namespace app\Presentation\Controller\Aluno\Reclamacoes;


use app\Application\UseCase\Computador\BuscarComputadorPorIdUseCase;
use app\Infrastructure\DataBase\Computador\ComputadorPorIdDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Aluno\Page;
use app\Presentation\Utilitarios\Componentes\CheckBox\allCheckBoxComponentes;
use app\Utils\View;

class ViewRegistrarReclamacao extends Page
{
    private ComputadorPorIdDAO $computadorPorIdDAO;

    public function __construct(ComputadorPorIdDAO $computadorPorIdDAO)
    {
        $this->computadorPorIdDAO = $computadorPorIdDAO;
    }

    public function getViewRegistrarReclamacao(Request $request, $codcomputador): string
    {
        $useCase = new BuscarComputadorPorIdUseCase(
            $this->computadorPorIdDAO
        );

        $obComputador = $useCase->execute($codcomputador,$request);

        $content = View::render('aluno/modules/inserirReclamacao/index', [
            'itens' => allCheckBoxComponentes::getComponenteCheckBox($request),
            'nav' => parent::getNav($request),
            'codcomputador' => $codcomputador,
            'codlaboratorio'=> $obComputador->getLaboratorio()->getCodlaboratorio(),
            'numerolaboratorio' => $obComputador->getLaboratorio()->getNumeroLaboratorio(),
            'patrimonio' => $obComputador->getPatrimonio(),
        ]);

        return parent::getPage('Reclamação',$content);
    }
}