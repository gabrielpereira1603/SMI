<?php

namespace app\Infrastructure\DataBase\Situacao;

use app\Domain\Entity\Componente;
use app\Domain\Entity\Situacao;
use app\Domain\Repository\Situacao\BuscarTodasSituacaoRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarTodasSituacaoDAO implements BuscarTodasSituacaoRepository
{
    public function buscarTodos(Request $request): ?array
    {

        $results = (new Database('situacao'))->select(null, null, null, null, '*', null)->fetchAll();

        if (!$results){
            return null;
        }

        $situacoes = [];

        foreach ($results as $situacaoData) {
            $situacoes[] = new Situacao(
                $situacaoData['codsituacao'],
                $situacaoData['tiposituacao']
            );
        }

        return $situacoes;
    }

    public function buscarTodosJSON(Request $request)
    {
        $results = (new Database('situacao'))->select(null, null, null, null, '*', null)->fetchAll();

        if (!$results) {
            return json_encode([]); // Retorna um array vazio em JSON
        }

        $situacoes = [];

        foreach ($results as $situacaoData) {
            $situacoes[] = [
                'codsituacao' => $situacaoData['codsituacao'],
                'tiposituacao' => $situacaoData['tiposituacao']
            ];
        }

        return ($situacoes);
    }
}