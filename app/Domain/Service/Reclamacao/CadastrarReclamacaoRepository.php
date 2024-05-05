<?php

namespace app\Domain\Service\Reclamacao;

interface CadastrarReclamacaoRepository
{
    //preciso passar na instancioa de reclamacao
    //descricao, prazoreclamacao = 1, status = Em Aberto, dataHora, datahora_Fimreclamcao = null, codcomputador_fk, codlaboratorio_fk, codusuario_fk
    public function cadastrarReclamacao(array $dadosReclamacao): int;

}