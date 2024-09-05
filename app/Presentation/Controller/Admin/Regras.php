<?php

namespace app\Presentation\Controller\Admin;

use app\Infrastructure\Http\Request;
use app\Utils\View;

class Regras extends Page
{
    public static function getView(Request $request): string
    {

        $content = View::render('admin/regras',[

        ]);

        return parent::getPanel('Termos de Uso', $content, 'termosDeUso');
    }
}