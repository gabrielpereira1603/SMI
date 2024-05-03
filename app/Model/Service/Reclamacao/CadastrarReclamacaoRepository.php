<?php

namespace app\Model\Service\Reclamacao;

use app\Model\Entity\Reclamacao;

interface CadastrarReclamacaoRepository
{
    //preciso passar na instancioa de reclamacao
    //descricao, prazoreclamacao = 1, status = Em Aberto, dataHora, datahora_Fimreclamcao = null, codcomputador_fk, codlaboratorio_fk, codusuario_fk
    public function cadastrarReclamacao(array $dadosReclamacao): int;

}