<?php

namespace app\Presentation\Controller\Aluno;

use app\Utils\View;

class RedefinirSenha extends Page
{
    public static function getViewRedefinirSenha($request): bool|array|string
    {
        $content = View::render('aluno/modules/redefinirSenha/index',[

        ]);
        return parent::getPage('Login Aluno',$content);
    }
}