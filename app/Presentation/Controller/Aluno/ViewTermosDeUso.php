<?php

namespace app\Presentation\Controller\Aluno;


use app\Infrastructure\Http\Request;
use app\Utils\View;

class ViewTermosDeUso extends Page
{
    public static function getView(Request $request): string
    {

        $content = View::render('aluno/regras',[

        ]);

        return parent::getPanel('Termos de Uso', $content, 'termosDeUso');
    }
}