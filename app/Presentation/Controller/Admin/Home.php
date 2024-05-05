<?php

namespace app\Controller\Admin;

use app\Http\Request;
use app\Model\Dao\Computador\ComputadorDao;
use app\Model\Dao\Laboratorio\LaboratorioDao;
use app\Utils\Componentes\Cards\cardLaboratorios;
use app\Utils\Service\Laboratorio\AdminLaboratorioStrategy;
use app\Utils\View;

class Home extends Page
{
    public static function getHome($request): string
    {
        $cardLaboratorio = cardLaboratorios::getLaboratorioItems($request, new AdminLaboratorioStrategy());
        $content = View::render('admin/modules/home/index',[
            'itens' => $cardLaboratorio
        ]);

        //RETONA A PAGINA COMPLETA
        return parent::getPanel('Home', $content, 'home');
    }
}