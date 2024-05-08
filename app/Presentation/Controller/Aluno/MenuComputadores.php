<?php

namespace app\Presentation\Controller\Aluno;

use app\Application\UseCase\Laboratorio\BuscarLaboratorioPorIdUseCase;
use app\Infrastructure\DataBase\Computador\ComputadorPorLaboratorioPaginationDAO;
use app\Infrastructure\DataBase\Laboratorio\BuscarLaboratorioPorIdDAO;
use app\Utils\View;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Pagination\Pagination;
use app\Application\UseCase\Computador\CardComputadoresPaginationUseCase;
use app\Infrastructure\DataBase\Computador\ComputadoresPorLaboratorioDAO;
use app\Presentation\Utilitarios\Service\Computador\cardComputadoresPagination\AlunoComputadorStrategy;

class MenuComputadores extends Page
{
    public static function getComputador(Request $request,$codlaboratorio): string
    {
        $useCase = new CardComputadoresPaginationUseCase(
            new AlunoComputadorStrategy(
                new ComputadorPorLaboratorioPaginationDAO(),
                new ComputadoresPorLaboratorioDAO()
            )
        );

        $laboratorioPorId = new BuscarLaboratorioPorIdUseCase(new BuscarLaboratorioPorIdDAO());

        $numerolaboratorio = $laboratorioPorId->execute($request,$codlaboratorio)->getNumeroLaboratorio();
        [$cardsComputadores, $obPagination] = $useCase->execute($request, $pagination, $codlaboratorio);

        $ViewPagination = (new Pagination())->getPagination($request, $obPagination);

        //CONTEUDO DA PAGINA DE RECLAMACAO
        $content = View::render('aluno/modules/computadoresReclamacao/index', [
            'nav' => parent::getNav($request),
            'itens' => $cardsComputadores,
            'codlaboratorio' => $codlaboratorio,
            'pagination' => $ViewPagination,
            'numerolaboratorio' => $numerolaboratorio

        ]);

        return parent::getPage('Computadores',$content);
    }
}