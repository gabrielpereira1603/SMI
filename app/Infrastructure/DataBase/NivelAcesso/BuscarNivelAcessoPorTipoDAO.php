<?php

namespace app\Infrastructure\DataBase\NivelAcesso;

use app\Domain\Entity\NivelAcesso;
use app\Domain\Repository\NivelAcesso\BuscarNivelAcessoPorTipoRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarNivelAcessoPorTipoDAO implements BuscarNivelAcessoPorTipoRepository
{

    public function buscarPorTipo(Request $request, $tipoAcesso): ?NivelAcesso
    {
        $where = "nivel_acesso.tipo_acesso = '$tipoAcesso'";

        $result = (new Database('nivel_acesso'))->select($where, null, null, null, '*', null)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $nivelAcessoData = $result[0];

        return new NivelAcesso(
            $nivelAcessoData['codnivel_acesso'],
            $nivelAcessoData['tipo_acesso']
        );
    }
}