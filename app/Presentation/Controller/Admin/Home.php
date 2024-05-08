<?php

namespace app\Presentation\Controller\Admin;

use app\Presentation\Utilitarios\Componentes\Cards\cardLaboratorios;
use app\Presentation\Utilitarios\Service\Laboratorio\cardLaboratorios\AdminCardLaboratorioStrategy;
use app\Utils\View;

class Home extends Page
{
    public static function getHome($request): string
    {
        $cardLaboratorio = cardLaboratorios::getLaboratorioItems($request, new AdminCardLaboratorioStrategy());
        $content = View::render('admin/modules/home/index',[
            'itens' => $cardLaboratorio
        ]);

        //RETONA A PAGINA COMPLETA
        return parent::getPanel('Home', $content, 'home');
    }
}