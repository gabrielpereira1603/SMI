<?php

namespace app\Model\UseCase\Reclamacao;

use app\Model\Dao\Reclamacao\ReclamacaoDao;

class BuscarDadosReclamacaoUseCase
{
    public function getDataReclamacao($codcomputador): array
    {
        $reclamacaoDao = new ReclamacaoDao();
        $results = $reclamacaoDao->getDetalhesByComputador($codcomputador);

        return [
            'codreclamacao' => $results ? $results->getCodreclamaca() : '0',
            'descricao'   => $results ? $results->getDescricao() : 'Nenhuma descrição Encontrada',
            'status'   => $results ? $results->getStatus() : 'Nenhum Status Encontrado',
            'dataHora'   => $results ? $results->getDataHoraReclamacao()->format('Y-m-d H:i:s') : 'Nenhuma Hora Encontrada',
            'numerolaboratorio' => $results ? $results->getComputador()->getLaboratorio()->getNumeroLaboratorio() : 'Nenhum Laboratório Encontrado',
            'patrimonio' => $results ? $results->getComputador()->getPatrimonio() : 'Nenhum Patrimônio Encontrado',
            'nome_usuario' => $results ? $results->getUsuario()->getNomeUsuario() : 'Nenhum Usuário Encontrado',
            'email_usuario' => $results ? $results->getUsuario()->getEmailUsuario() : 'Nenhum Usuário Encontrado',
            'login' => $results ? $results->getUsuario()->getLogin() : 'Nenhum Usuário Encontrado',
        ];
    }
}