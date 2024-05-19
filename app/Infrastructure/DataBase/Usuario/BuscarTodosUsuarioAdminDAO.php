<?php

namespace app\Infrastructure\DataBase\Usuario;

use app\Domain\Entity\NivelAcesso;
use app\Domain\Entity\Reclamacao;
use app\Domain\Entity\Usuario;
use app\Domain\Repository\Usuario\BuscarTodosUsuarioAdminRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarTodosUsuarioAdminDAO implements BuscarTodosUsuarioAdminRepository
{
    public function buscarTodos(Request $request): ?array
    {
        $where = "usuario.nivelacesso_fk = 3";
        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';
        $fields = 'usuario.*, nivel_acesso.codnivel_acesso, nivel_acesso.tipo_acesso';

        $result = (new Database('usuario'))->select($where, null, null, null, $fields, $join)->fetchAll();

        if (empty($result)){
            return null;
        }

        $usuarios = [];

        foreach ($result as $data) {
            $usuarios[] = Usuario::factoryUsuario($data);
        }

        return $usuarios;
    }
}