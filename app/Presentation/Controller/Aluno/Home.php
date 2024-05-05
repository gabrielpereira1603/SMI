<?php

namespace app\Presentation\Controller\Aluno;

use app\Presentation\Utilitarios\Componentes\Cards\cardLaboratorios;
use app\Presentation\Utilitarios\Service\Laboratorio\AlunoLaboratorioStrategy;
use app\Utils\View;

class Home extends Page
{
    public static function getHome($request): string
    {
        $cardLaboratorio = cardLaboratorios::getLaboratorioItems($request, new AlunoLaboratorioStrategy());

        $content = View::render('aluno/modules/home/index',[
            'itens' => $cardLaboratorio
        ]);

        return parent::getPanel('Home', $content, 'home');
    }
}