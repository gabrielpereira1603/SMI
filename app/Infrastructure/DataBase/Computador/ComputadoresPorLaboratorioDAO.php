<?php

namespace app\Infrastructure\DataBase\Computador;

use app\Domain\Entity\Computador;
use app\Domain\Entity\Laboratorio;
use app\Domain\Entity\Situacao;
use app\Domain\Repository\Computador\BuscarComputadorPorLaboratorioRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class ComputadoresPorLaboratorioDAO implements BuscarComputadorPorLaboratorioRepository
{
    public function buscarComputadorPorLaboratorio(Request $request, $codlaboratorio): array
    {
        $where = "computador.codlaboratorio_fk = $codlaboratorio";

        $join = 'INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
                INNER JOIN laboratorio ON computador.codlaboratorio_fk = laboratorio.codlaboratorio';

        $order = 'patrimonio ASC';

        $results = (new Database('computador'))->select($where, $order,null,null,'*', $join)->fetchAll();


        $computadores = [];

        foreach ($results as $computadorData) {
            $situacao = new Situacao($computadorData['codsituacao'], $computadorData['tiposituacao']);
            $laboratorio = new Laboratorio($computadorData['codlaboratorio'], $computadorData['numerolaboratorio']);

            $computadores[] = new Computador(
                $computadorData['codcomputador'],
                $computadorData['patrimonio'],
                $situacao,
                $laboratorio
            );
        }

        return $computadores;
    }
}