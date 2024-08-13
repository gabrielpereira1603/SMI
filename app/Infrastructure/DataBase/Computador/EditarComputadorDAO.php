<?php

namespace app\Infrastructure\DataBase\Computador;

use WilliamCosta\DatabaseManager\Database;

class EditarComputadorDAO
{
    public static function editarComputador($codcomputador, $valoresParaAlterar)
    {
        if (empty($valoresParaAlterar)) {
            return false;
        }

        $whereClause = "codcomputador = $codcomputador";

        $database = new Database('computador');
        $result = $database->update($whereClause, $valoresParaAlterar);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}