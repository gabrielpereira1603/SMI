<?php

namespace app\Presentation\Utilitarios\Componentes\Select;

use app\Infrastructure\Dao\Usuario\UsuarioDao;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectTodosUsuarios extends Page
{
    public static function getAll($request): string
    {
        $usuarios = (new UsuarioDao())->getAll();
        $itens = '';
        foreach ($usuarios as $obUsuario) {
            $itens .= View::render('admin/usuario/selectTodosUsuarios', [
                'codusuario' => $obUsuario->getCodusuario(),
                'nome_usuario' => $obUsuario->getNomeUsuario()
            ]);
        }


        return $itens;
    }

}