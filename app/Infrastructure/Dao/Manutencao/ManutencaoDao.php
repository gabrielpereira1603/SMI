<?php

namespace app\Domain\Dao\Manutencao;

use app\Domain\Service\Manutencao\ManutencaoRepository;
use WilliamCosta\DatabaseManager\Database;

class ManutencaoDao implements ManutencaoRepository
{
    public function createManutencao(string $descricao,$codUsuario,$codreclamacao): bool
    {
        $datahora_manutencao = date('Y-m-d H:i:s');

        $database = new Database('manutencao');
        $result = $database->insert([
            'descricao_manutencao' => $descricao,
            'datahora_manutencao' => $datahora_manutencao,
            'codusuario_fk' => $codUsuario,
            'codreclamacao_fk' => $codreclamacao
        ]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}