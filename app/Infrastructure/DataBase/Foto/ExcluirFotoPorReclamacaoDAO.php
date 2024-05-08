<?php

namespace app\Infrastructure\DataBase\Foto;

use app\Domain\Repository\Foto\ExcluirFotoRepository;
use WilliamCosta\DatabaseManager\Database;

class ExcluirFotoPorReclamacaoDAO implements ExcluirFotoRepository
{
    public function exlcuirFoto(int $codreclamacao): bool
    {
        $database = new Database('foto');
        $where = "codreclamacao_fk = $codreclamacao";
        if ($database->delete($where)){
            return true;
        }
        return false;
    }

    public function fotoExiste($codreclamacao): bool
    {
        $database = new Database('foto');
        $where = "codreclamacao_fk = $codreclamacao";

        if ($database->select($where,null,null,null,'*',null,)->fetchAll()){
            return true;
        }
        return false;
    }

}