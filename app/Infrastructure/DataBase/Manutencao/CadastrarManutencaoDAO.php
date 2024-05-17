<?php

namespace app\Infrastructure\DataBase\Manutencao;

use app\Domain\Repository\Manutencao\CadastrarManutencaoRepository;
use WilliamCosta\DatabaseManager\Database;

class CadastrarManutencaoDAO implements CadastrarManutencaoRepository
{
    public function cadastrarManutencao($descricao, $codusuario, $codreclamacao): ?int
    {
        $datahora_manutencao = date('Y-m-d H:i:s');

        $database = new Database('manutencao');
        $lastId = $database->insert([
            'descricao_manutencao' => $descricao,
            'datahora_manutencao' => $datahora_manutencao,
            'codusuario_fk' => $codusuario,
            'codreclamacao_fk' => $codreclamacao
        ]);

        if ($lastId) {
            return $lastId;
        } else {
            return false;
        }
    }
}