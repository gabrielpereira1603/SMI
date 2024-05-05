<?php

namespace app\Utils\Componentes\Select;

use app\Model\Dao\Usuario\UsuarioDao;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectTodosUsuarios extends Page
{
    public static function getAll($request): string
    {
        $usuarios = (new UsuarioDao())->getAll();
        foreach ($usuarios as $obUsuario) {
            $itens .= View::render('admin/usuario/selectTodosUsuarios', [
                'codusuario' => $obUsuario->getCodusuario(),
                'nome_usuario' => $obUsuario->getNomeUsuario()
            ]);
        }


        return $itens;
    }

}