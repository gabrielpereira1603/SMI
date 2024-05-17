<?php

namespace app\Domain\Repository\Manutencao;

interface CadastrarManutencaoRepository
{
    public function cadastrarManutencao($descricao,$codusuario,$codreclamacao): ?int;
}