<?php

namespace app\Infrastructure\Dao\Computador;

use app\Domain\Entity\Computador;
use app\Domain\Entity\Laboratorio;
use app\Domain\Entity\Situacao;
use app\Domain\Service\Computador\ComputadorRepository;
use WilliamCosta\DatabaseManager\Database;

class ComputadorDao implements ComputadorRepository
{

    public function getComputadoresLaboratorio($codlaboratorio): array
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
    public static function getComputadoresLaboratorioPagination($codlaboratorio, $obPagination, $limit, $offset): array
    {
        $where = "computador.codlaboratorio_fk = $codlaboratorio";

        $join = 'INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
             INNER JOIN laboratorio ON computador.codlaboratorio_fk = laboratorio.codlaboratorio';

        $orderBy = 'patrimonio ASC'; // Alteração aqui

        $results = (new Database('computador'))->select($where, $orderBy, $limit, $offset, '*', $join)->fetchAll(); // Alteração aqui

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
    public function updateComputador(int $codcomputador, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        $whereClause = "codcomputador = $codcomputador";

        $database = new Database('computador');
        $result = $database->update($whereClause, $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getById($codcomputador): ?Computador
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