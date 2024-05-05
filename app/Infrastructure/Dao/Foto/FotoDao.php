<?php

namespace app\Infrastructure\Dao\Foto;

use app\Domain\Service\Foto\FotoRepository;
use WilliamCosta\DatabaseManager\Database;

class FotoDao implements FotoRepository
{
    public function buscarPorReclamacao($codreclamacao): array
    {
        $where = "codreclamacao_fk = $codreclamacao";

        $fields = "foto.*, foto.foto";

        return (new Database('foto'))->select($where, null, null,null, $fields, null)->fetchAll();
    }
}