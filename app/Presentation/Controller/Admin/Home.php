<?php

namespace app\Presentation\Controller\Admin;

use app\Application\UseCase\Laboratorio\CardLaboratorioUseCase;
use app\Infrastructure\DataBase\Computador\ComputadoresPorLaboratorioDAO;
use app\Infrastructure\DataBase\Laboratorio\BuscarTodosLaboratoriosDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Utilitarios\Service\Laboratorio\cardLaboratorios\AdminCardLaboratorioStrategy;
use app\Utils\View;

class Home extends Page
{
    public static function getHome(Request $request): string
    {
        $useCase = new CardLaboratorioUseCase(
            new AdminCardLaboratorioStrategy(
                new BuscarTodosLaboratoriosDAO(),
                new ComputadoresPorLaboratorioDAO()
            )
        );

        $cardLaboratorio = $useCase->execute($request);

        $content = View::render('admin/modules/home/index',[
            'itens' => $cardLaboratorio
        ]);

        //RETONA A PAGINA COMPLETA
        return parent::getPanel('Home', $content, 'home');
    }
}