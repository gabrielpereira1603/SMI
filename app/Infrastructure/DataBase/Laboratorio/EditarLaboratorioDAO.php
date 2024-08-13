<?php

namespace app\Infrastructure\DataBase\Laboratorio;

use app\Domain\Entity\Laboratorio;
use WilliamCosta\DatabaseManager\Database;

class EditarLaboratorioDAO
{
    public static function editaLaboratorio(int $codLaboratorio, array $valoresParaAlterar): bool
    {
        if (empty($valoresParaAlterar)) {
            return false;
        }

        $whereClause = "codlaboratorio = $codLaboratorio";

        $database = new Database('laboratorio');
        $result = $database->update($whereClause, $valoresParaAlterar);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function laboratorioJaCadastrado($numerolaboratorio)
    {
        $where = "laboratorio.numerolaboratorio = '$numerolaboratorio' ";

        $result = (new Database('laboratorio'))->select($where, null, null, null, '*', null)->fetchAll();

        if (empty($result)) {
            return false;
        }

        return true;
    }

}