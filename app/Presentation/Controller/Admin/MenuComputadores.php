<?php

namespace app\Controller\Admin;

use app\Controller\Pagination\Pagination;
use app\Model\Dao\Laboratorio\LaboratorioDao;
use app\Utils\Componentes\Cards\cardComputadoresPagination;
use app\Utils\Service\Computador\adminComputadorStrategy;
use app\Utils\View;

class MenuComputadores extends Page
{

    public static function getComputador($request,$codlaboratorio): string
    {
        $cardsComputadores = cardComputadoresPagination::getComputadorItems($request,$codlaboratorio,$obPagination, new AdminComputadorStrategy());
        $numeroLaboratorio = (new LaboratorioDao())->getById($codlaboratorio)->getNumeroLaboratorio();
        $pagination = (new Pagination())->getPagination($request, $obPagination);

        //CONTEUDO DA PAGINA DE RECLAMACAO
        $content = View::render('admin/modules/computadoresManutencao/index', [
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