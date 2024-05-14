<?php

namespace app\Infrastructure\DataBase\Usuario;

use app\Domain\Repository\Usuario\RedefinirSenhaUsuarioRepository;
use WilliamCosta\DatabaseManager\Database;

class RedefinirSenhaUsuarioDAO implements RedefinirSenhaUsuarioRepository
{

    public function redefinirSenha(int $codusuario, array $dados): bool
    {
        if (empty($dados)) {
            return false;
        }


        $whereClause = "codusuario = $codusuario";

        $database = new Database('usuario');
        $result = $database->update($whereClause, $dados);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}