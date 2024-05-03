<?php

namespace app\Model\Service\Reclamacao;

use app\Model\Entity\Reclamacao;

interface ReclamacaoRepository
{
    //public function getAll(): Reclamacao;

    public function getDetalhesByComputador(string $codcomputador): ?Reclamacao;

    //public function create(Reclamacao $reclamacao): Reclamacao;

    public function updateReclamacao(int $id, array $data): bool;

    //public function delete(int $id): bool;
}