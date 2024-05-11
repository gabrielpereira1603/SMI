<?php

namespace app\Domain\Repository\Reclamacao;

interface CadastrarReclamacaoRepository
{
    public function cadastrarReclamacao(array $dadosReclamacao): int;

}