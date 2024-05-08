<?php

namespace app\Domain\Service\Foto;

interface InserirFotoReclamacaoRepository
{
    public function cadastrarFotoReclamacao(array $foto, int $codreclamacao): int|bool;
}