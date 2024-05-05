<?php

namespace app\Controller\Aluno;

use app\Controller\Pagination\Pagination;
use app\Http\Request;
use app\Model\Dao\Laboratorio\LaboratorioDao;
use app\Utils\Componentes\Cards\cardComputadoresPagination;
use app\Utils\Service\Computador\AlunoComputadorStrategy;
use app\Utils\View;

class MenuComputadores extends Page
{
    public static function getComputador(Request $request,$codlaboratorio): string
    {
        $cardsComputadores = cardComputadoresPagination::getComputadorItems($request,$codlaboratorio,$obPagination, new AlunoComputadorStrategy());
        $numeroLaboratorio = (new LaboratorioDao())->getById($codlaboratorio)->getNumeroLaboratorio();
        $pagination = (new Pagination())->getPagination($request, $obPagination);

        //CONTEUDO DA PAGINA DE RECLAMACAO
        $content = View::render('aluno/modules/computadoresReclamacao/index', [
            'nav' => parent::getNav($request),
            'itens' => $cardsComputadores,
            'pagination' => $pagination,
            'codlaboratorio' => $codlaboratorio,
            'numerolaboratorio' => $numeroLaboratorio,
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPage('Computadores',$content);
    }


}