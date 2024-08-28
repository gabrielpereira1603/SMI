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
        // Adiciona a condição para que os patrimônios sejam entre 1 e 15
        $where = "computador.codlaboratorio_fk = $codlaboratorio";

        $join = 'INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
                INNER JOIN laboratorio ON computador.codlaboratorio_fk = laboratorio.codlaboratorio';

        // Ordena os resultados pelo patrimônio em ordem crescente
        $order = 'CAST(computador.patrimonio AS UNSIGNED) ASC';

        // Realiza a consulta no banco de dados
        $results = (new Database('computador'))->select($where, $order, null, null, '*', $join)->fetchAll();

        // Inicializa o array de computadores
        $computadores = [];

        // Itera sobre os resultados e cria os objetos Computador
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

        // Retorna o array de computadores
        return $computadores;
    }
}
