<?php

namespace app\Infrastructure\DataBase\Foto;

use app\Domain\Repository\Foto\InserirFotoReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class InserirFotoReclamacaoDAO implements InserirFotoReclamacaoRepository
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