<?php

namespace app\Model\Service\Manutencao;

use app\Model\Entity\Reclamacao;
use app\Model\Entity\Usuario;

interface ManutencaoRepository
{
    public function createManutencao(string $descricao,$codUsuario,$codreclamacao): bool;
}