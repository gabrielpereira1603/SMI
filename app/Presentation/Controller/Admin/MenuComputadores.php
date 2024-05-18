<?php

namespace app\Presentation\Controller\Admin;

use app\Application\UseCase\Computador\CardComputadoresPaginationUseCase;
use app\Application\UseCase\Laboratorio\BuscarLaboratorioPorIdUseCase;
use app\Infrastructure\DataBase\Computador\ComputadoresPorLaboratorioDAO;
use app\Infrastructure\DataBase\Computador\ComputadorPorLaboratorioPaginationDAO;
use app\Infrastructure\DataBase\Laboratorio\BuscarLaboratorioPorIdDAO;
use app\Presentation\Controller\Pagination\Pagination;
use app\Presentation\Utilitarios\Service\Computador\cardComputadoresPagination\AdminComputadorStrategy;
use app\Utils\View;

class MenuComputadores extends Page
{

    public static function getComputador($request,$codlaboratorio): string
    {
        $useCase = new CardComputadoresPaginationUseCase(
            new AdminComputadorStrategy(
                new ComputadorPorLaboratorioPaginationDAO(),
                new ComputadoresPorLaboratorioDAO()
            )
        );

        $laboratorioPorId = new BuscarLaboratorioPorIdUseCase(
            new BuscarLaboratorioPorIdDAO()
        );
        $numerolaboratorio = $laboratorioPorId->execute($request,$codlaboratorio)->getNumeroLaboratorio();
        [$cardsComputadores, $obPagination] = $useCase->execute($request, $pagination, $codlaboratorio);

        $ViewPagination = (new Pagination())->getPagination($request, $obPagination);

        //CONTEUDO DA PAGINA DE RECLAMACAO
        $content = View::render('admin/modules/computadoresManutencao/index', [
            'nav' => parent::getNav($request),
            'itens' => $cardsComputadores,
            'pagination' => $ViewPagination,
            'codlaboratorio' => $codlaboratorio,
            'numerolaboratorio' => $numerolaboratorio
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPage('Computadores',$content);
    }
}