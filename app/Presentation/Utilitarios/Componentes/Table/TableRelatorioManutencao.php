<?php

namespace app\Presentation\Utilitarios\Componentes\Table;

use app\Infrastructure\Dao\Relatorio\RelatorioManutencaoDao;
use app\Utils\View;

class TableRelatorioManutencao
{
    public static function buscarDadosRelatorioManutencao($usuario,$laboratorio,$computador,$dataInicio,$dataFim): string
    {
        $result = (new RelatorioManutencaoDao())->buscarDadosRelatorioManutencao($usuario,$laboratorio,$computador,$dataInicio,$dataFim);

        foreach ($result as $obManutencao) {
            $itens .= View::render('admin/modules/relatorio/manutencao/itensTable', [
                'datahora_manutencao' => isset($obManutencao['datahora_manutencao']) ? $obManutencao['datahora_manutencao'] : 'Nenhuma data encontrada',
                'nome_usuario_manutencao' => isset($obManutencao[2]) ? $obManutencao[2] : 'Nenhum nome usuário encontrado',
                'descricao_manutencao' => isset($obManutencao[1]) ? $obManutencao[1] : 'Nenhuma descrição encontrada',
                'status_reclamacao' => isset($obManutencao[5]) ? $obManutencao[5] : 'Nenhum status de reclamação encontrado',
                'patrimonio' => isset($obManutencao[6]) ? $obManutencao[6] : 'Nenhum patrimônio encontrado',
                'numerolaboratorio' => isset($obManutencao[7]) ? $obManutencao[7] : 'Nenhum número de laboratório encontrado',
                'descricao_reclamacao' => isset($obManutencao[8]) ? $obManutencao[8] : 'Nenhuma descrição de reclamação encontrada',
                'datahora_reclamacao' => isset($obManutencao[9]) ? $obManutencao[9] : 'Nenhuma data e hora de reclamação encontrada',
                'componentes' => isset($obManutencao[10]) ? $obManutencao[10] : 'Nenhum componente encontrado',
                'nome_usuario_reclamacao' => isset($obManutencao[11]) ? $obManutencao[11] : 'Nenhum nome de usuário de reclamação encontrado',
                'login_reclamacao' => isset($obManutencao[12]) ? $obManutencao[12] : 'Nenhum login de usuário de reclamação encontrado',
            ]);
        }
        return $itens;
    }
}