<?php

namespace app\Presentation\Utilitarios\Componentes\Table;

use app\Infrastructure\Dao\Usuario\UsuarioDao;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class UsuarioSemPermissao extends Page
{
    public static function NotPermissao($request): string
    {
        $itens = '';
        $usuarios = (new UsuarioDao())->getUsuarioSemPermissao();
        foreach ($usuarios as $obUsuario) {
            $itens .= View::render('admin/semPermissao/item', [
                'login' => $obUsuario->getLogin(),
                'nome_usuario' => $obUsuario->getNomeUsuario(),
                'email_usuario' => $obUsuario->getEmailUsuario(),
            ]);
        }
        return $itens;
    }

}