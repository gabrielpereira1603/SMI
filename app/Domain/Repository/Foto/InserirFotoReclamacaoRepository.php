<?php

namespace app\Domain\Repository\Foto;

interface InserirFotoReclamacaoRepository
{
    public function cadastrarFotoReclamacao(array $foto, int $codreclamacao): int|bool;
}