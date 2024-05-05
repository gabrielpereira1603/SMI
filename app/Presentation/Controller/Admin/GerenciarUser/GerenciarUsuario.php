<?php

namespace app\Presentation\Controller\Admin\GerenciarUser;

use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class GerenciarUsuario extends Page
{
    public static function getViewGerenciarUser($request): string
    {
        $userData = $_SESSION['admin']['usuario'];
        $codUsuario = $userData['codusuario'];
        $tipousuario = $userData['tipo_acesso'];

        $content = View::render('admin/modules/gerenciarUser/index', [
            'codusuario' => $codUsuario,
            'tipouser' => $tipousuario,
        ]);

        return parent::getPanel('Gerenciar Usuários', $content, 'user');
    }
}