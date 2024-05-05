<?php

namespace app\Domain\Service\Manutencao;

interface ManutencaoRepository
{
    public function createManutencao(string $descricao,$codUsuario,$codreclamacao): bool;
}