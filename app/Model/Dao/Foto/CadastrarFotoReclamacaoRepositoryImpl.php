<?php

namespace app\Model\Dao\Foto;

use app\Model\Service\Foto\InserirFotoReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class CadastrarFotoReclamacaoRepositoryImpl implements InserirFotoReclamacaoRepository
{
    public function cadastrarFotoReclamacao(array $foto, int $codreclamacao): int|bool
    {
        $database = new Database('foto');
        $lastIdFoto = $database->insert([
            'foto' => $foto,
            'codreclamacao_fk' => $codreclamacao
        ]);

        if (!$lastIdFoto){
            return false;
        }

        return $lastIdFoto;
    }
}