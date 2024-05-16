<?php

namespace app\Presentation\Controller\Aluno;

use app\Application\UseCase\Laboratorio\CardLaboratorioUseCase;
use app\Infrastructure\DataBase\Computador\ComputadoresPorLaboratorioDAO;
use app\Infrastructure\DataBase\Laboratorio\BuscarTodosLaboratoriosDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Utilitarios\Service\Laboratorio\cardLaboratorios\AlunoCardLaboratorioStrategy;
use app\Utils\View;

class Home extends Page
{
    public static function getHome(Request $request): string
    {
        $useCase = new CardLaboratorioUseCase(
            new AlunoCardLaboratorioStrategy(
                new BuscarTodosLaboratoriosDAO(),
                new ComputadoresPorLaboratorioDAO()
            )
        );

        $cardLaboratorio = $useCase->execute($request);

        $content = View::render('aluno/modules/home/index',[
            'itens' => $cardLaboratorio
        ]);

        return parent::getPanel('Home', $content, 'home');
    }
}