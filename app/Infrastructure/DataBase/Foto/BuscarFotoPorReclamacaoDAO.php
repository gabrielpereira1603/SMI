<?php

namespace app\Infrastructure\DataBase\Foto;

use app\Domain\Entity\Foto;
use app\Domain\Repository\Foto\BuscarFotoPorReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class BuscarFotoPorReclamacaoDAO implements BuscarFotoPorReclamacaoRepository
{

    public function buscarFoto($codreclamacao): ?Foto
    {
        $where = "codreclamacao_fk = $codreclamacao";

        $fields = "foto.*, foto.foto";

        $result = (new Database('foto'))->select($where, null, null,null, $fields, null)->fetchAll();
        var_dump($result);
        $obFoto = new Foto(
            $result['codfoto'],
            $result['foto'],
            $result['codreclamacao_fk']
        );
        var_dump($obFoto);
        return new Foto(
            $result['codfoto'],
            $result['foto'],
            $result['codreclamacao_fk']
        );
    }
}