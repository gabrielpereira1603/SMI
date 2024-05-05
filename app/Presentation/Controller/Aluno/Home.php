<?php

namespace app\Controller\Aluno;

use app\Utils\Componentes\Cards\cardLaboratorios;
use app\Utils\Service\Laboratorio\AlunoLaboratorioStrategy;
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