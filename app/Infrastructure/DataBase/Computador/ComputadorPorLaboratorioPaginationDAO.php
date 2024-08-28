<?php

namespace app\Infrastructure\DataBase\Computador;

use app\Domain\Entity\Computador;
use app\Domain\Entity\Laboratorio;
use app\Domain\Entity\Situacao;
use app\Domain\Repository\Computador\BuscarComputadorLaboratorioPaginationRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class ComputadorPorLaboratorioPaginationDAO implements BuscarComputadorLaboratorioPaginationRepository
{

    public function buscarComputadorPorLaboratorioPagination(Request $request, &$obPagination, $codlaboratorio, $limit, $offset): array
    {
        $where = "computador.codlaboratorio_fk = $codlaboratorio";

        $join = 'INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
                INNER JOIN laboratorio ON computador.codlaboratorio_fk = laboratorio.codlaboratorio';

        // Ordena os resultados pelo patrimônio em ordem crescente
        $order = 'CAST(computador.patrimonio AS UNSIGNED) ASC';

        $results = (new Database('computador'))->select($where, $order,$limit,$offset,'*', $join)->fetchAll();


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