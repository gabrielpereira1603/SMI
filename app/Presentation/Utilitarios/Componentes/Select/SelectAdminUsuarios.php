<?php

namespace app\Presentation\Utilitarios\Componentes\Select;

use app\Application\UseCase\Usuario\BuscarTodosUsuarioAdminUseCase;
use app\Infrastructure\Dao\Usuario\UsuarioDao;
use app\Infrastructure\DataBase\Usuario\BuscarTodosUsuarioAdminDAO;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectAdminUsuarios extends Page
{
    public static function getAdminUsers($request): string
    {
        $useCase = new BuscarTodosUsuarioAdminUseCase(
            new BuscarTodosUsuarioAdminDAO
        );

        $usuarios = $useCase->execute($request);

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