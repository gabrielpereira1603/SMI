<?php

namespace app\Infrastructure\DataBase\Computador;

use app\Domain\Entity\Computador;
use app\Domain\Entity\Laboratorio;
use app\Domain\Entity\Situacao;
use app\Domain\Repository\Computador\BuscarComputadorPorIdRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class ComputadorPorIdDAO implements BuscarComputadorPorIdRepository
{
    public function buscaPorId(int $codcomputador, Request $request): ?Computador
    {
        $where = "computador.codcomputador = '$codcomputador'";
        $join = 'INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
                INNER JOIN laboratorio ON computador.codlaboratorio_fk = laboratorio.codlaboratorio';

        $result = (new Database('computador'))->select($where, null, null, null, '*', $join)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $computadorData = $result[0];
        $situacao = new Situacao($computadorData['codsituacao'], $computadorData['tiposituacao']);
        $laboratorio = new Laboratorio($computadorData['codlaboratorio'], $computadorData['numerolaboratorio']);

        return new Computador(
            $computadorData['codcomputador'],
            $computadorData['patrimonio'],
            $situacao,
            $laboratorio
        );
    }
}