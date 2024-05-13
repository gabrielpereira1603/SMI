<?php

namespace app\Infrastructure\DataBase\Usuario;

use app\Domain\Repository\Usuario\GerarTokenRedefinirSenharRepository;
use WilliamCosta\DatabaseManager\Database;

class GerarTokenRedefinirSenhaDAO implements GerarTokenRedefinirSenharRepository
{
    public function gerarToken(int $codusuario,$dadosToken): bool
    {
        if (empty($dadosToken)) {
            return false;
        }

        $whereClause = "codusuario = $codusuario";

        $database = new Database('usuario');
        $result = $database->update($whereClause, $dadosToken);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}