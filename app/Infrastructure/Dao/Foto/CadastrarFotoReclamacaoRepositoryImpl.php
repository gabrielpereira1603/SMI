<?php

namespace app\Domain\Dao\Foto;

use app\Domain\Service\Foto\InserirFotoReclamacaoRepository;
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