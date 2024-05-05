<?php

namespace app\Domain\Dao\Relatorio;

use WilliamCosta\DatabaseManager\Database;

class RelatorioManutencaoDao
{
    public function buscarDadosRelatorioManutencao($usuario, $laboratorio, $computador, $dataInicio, $dataFim)
    {
        if($laboratorio == -1 && $computador == -1 && $usuario == -1)
        {
            $fields = ' 
            manutencao.datahora_manutencao, 
            manutencao.descricao_manutencao, 
            usuario_manutencao.nome_usuario AS nome_usuario_manutencao, 
            usuario_manutencao.login AS login_manutencao, 
            usuario_manutencao.nivelacesso_fk AS nivelacesso_fk_manutencao, 
            reclamacao.status AS status_reclamacao, 
            computador.patrimonio, 
            laboratorio.numerolaboratorio, 
            reclamacao.descricao AS descricao_reclamacao, 
            reclamacao.datahora_reclamacao, 
            GROUP_CONCAT(componente.nome_componente) AS componentes,
            usuario_reclamacao.nome_usuario AS nome_usuario_reclamacao, 
            usuario_reclamacao.login AS login_reclamacao, 
            usuario_reclamacao.nivelacesso_fk AS nivelacesso_fk_reclamacao';

            $join = '
             INNER JOIN usuario AS usuario_manutencao ON manutencao.codusuario_fk = usuario_manutencao.codusuario 
            LEFT JOIN reclamacao ON manutencao.codreclamacao_fk = reclamacao.codreclamacao 
            LEFT JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador 
            LEFT JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
            LEFT JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
            LEFT JOIN componente ON reclamacao_componente.codcomponente_fk = componente.codcomponente 
            LEFT JOIN usuario AS usuario_reclamacao ON reclamacao.codusuario_fk = usuario_reclamacao.codusuario';

            $where = "(manutencao.datahora_manutencao BETWEEN '$dataInicio' AND '$dataFim') GROUP BY manutencao.codmanutencao";
        }
        else if($laboratorio == -1 && $computador == -1)
        {
            $fields = '                
            manutencao.datahora_manutencao, 
            manutencao.descricao_manutencao, 
            usuario_manutencao.nome_usuario AS nome_usuario_manutencao, 
            usuario_manutencao.login AS login_manutencao, 
            usuario_manutencao.nivelacesso_fk AS nivelacesso_fk_manutencao, 
            reclamacao.status AS status_reclamacao, 
            computador.patrimonio, 
            laboratorio.numerolaboratorio, 
            reclamacao.descricao AS descricao_reclamacao, 
            reclamacao.datahora_reclamacao, 
            GROUP_CONCAT(componente.nome_componente) AS componentes,
            usuario_reclamacao.nome_usuario AS nome_usuario_reclamacao, 
            usuario_reclamacao.login AS login_reclamacao, 
            usuario_reclamacao.nivelacesso_fk AS nivelacesso_fk_reclamacao';

            $where = "(manutencao.datahora_manutencao BETWEEN '$dataInicio' AND '$dataFim') 
            AND manutencao.codusuario_fk = $usuario 
            GROUP BY manutencao.codmanutencao";

            $join = '
            INNER JOIN usuario AS usuario_manutencao ON manutencao.codusuario_fk = usuario_manutencao.codusuario 
            LEFT JOIN reclamacao ON manutencao.codreclamacao_fk = reclamacao.codreclamacao 
            LEFT JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador 
            LEFT JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
            LEFT JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
            LEFT JOIN componente ON reclamacao_componente.codcomponente_fk = componente.codcomponente 
            LEFT JOIN usuario AS usuario_reclamacao ON reclamacao.codusuario_fk = usuario_reclamacao.codusuario';
        }
        else if($usuario == -1 && $computador == -2)
        {
            $fields = '                
            manutencao.datahora_manutencao, 
            manutencao.descricao_manutencao, 
            usuario_manutencao.nome_usuario AS nome_usuario_manutencao, 
            usuario_manutencao.login AS login_manutencao, 
            usuario_manutencao.nivelacesso_fk AS nivelacesso_fk_manutencao, 
            reclamacao.status AS status_reclamacao, 
            computador.patrimonio, 
            laboratorio.numerolaboratorio, 
            reclamacao.descricao AS descricao_reclamacao, 
            reclamacao.datahora_reclamacao, 
            GROUP_CONCAT(componente.nome_componente) AS componentes,
            usuario_reclamacao.nome_usuario AS nome_usuario_reclamacao, 
            usuario_reclamacao.login AS login_reclamacao, 
            usuario_reclamacao.nivelacesso_fk AS nivelacesso_fk_reclamacao';

            $where = "(manutencao.datahora_manutencao BETWEEN '$dataInicio' AND '$dataFim') 
            AND laboratorio.codlaboratorio = $laboratorio 
            GROUP BY manutencao.codmanutencao";

            $join = '
            INNER JOIN usuario AS usuario_manutencao ON manutencao.codusuario_fk = usuario_manutencao.codusuario 
            LEFT JOIN reclamacao ON manutencao.codreclamacao_fk = reclamacao.codreclamacao 
            LEFT JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador 
            LEFT JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
            LEFT JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
            LEFT JOIN componente ON reclamacao_componente.codcomponente_fk = componente.codcomponente 
            LEFT JOIN usuario AS usuario_reclamacao ON reclamacao.codusuario_fk = usuario_reclamacao.codusuario';
        }
        else if ($computador == -2)
        {
            $fields = '                
            manutencao.datahora_manutencao, 
            manutencao.descricao_manutencao, 
            usuario_manutencao.nome_usuario AS nome_usuario_manutencao, 
            usuario_manutencao.login AS login_manutencao, 
            usuario_manutencao.nivelacesso_fk AS nivelacesso_fk_manutencao, 
            reclamacao.status AS status_reclamacao, 
            computador.patrimonio, 
            laboratorio.numerolaboratorio, 
            reclamacao.descricao AS descricao_reclamacao, 
            reclamacao.datahora_reclamacao, 
            GROUP_CONCAT(componente.nome_componente) AS componentes,
            usuario_reclamacao.nome_usuario AS nome_usuario_reclamacao, 
            usuario_reclamacao.login AS login_reclamacao, 
            usuario_reclamacao.nivelacesso_fk AS nivelacesso_fk_reclamacao';

            $where = "(manutencao.datahora_manutencao BETWEEN '$dataInicio' AND '$dataFim')
            AND manutencao.codusuario_fk = $usuario
            AND laboratorio.codlaboratorio = $laboratorio
            GROUP BY manutencao.codmanutencao";

            $join = '
            INNER JOIN usuario AS usuario_manutencao ON manutencao.codusuario_fk = usuario_manutencao.codusuario 
            LEFT JOIN reclamacao ON manutencao.codreclamacao_fk = reclamacao.codreclamacao 
            LEFT JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador 
            LEFT JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
            LEFT JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
            LEFT JOIN componente ON reclamacao_componente.codcomponente_fk = componente.codcomponente 
            LEFT JOIN usuario AS usuario_reclamacao ON reclamacao.codusuario_fk = usuario_reclamacao.codusuario';

        }
        else
        {
            $fields = '                
            manutencao.datahora_manutencao, 
            manutencao.descricao_manutencao, 
            usuario_manutencao.nome_usuario AS nome_usuario_manutencao, 
            usuario_manutencao.login AS login_manutencao, 
            usuario_manutencao.nivelacesso_fk AS nivelacesso_fk_manutencao, 
            reclamacao.status AS status_reclamacao, 
            computador.patrimonio, 
            laboratorio.numerolaboratorio, 
            reclamacao.descricao AS descricao_reclamacao, 
            reclamacao.datahora_reclamacao, 
            GROUP_CONCAT(componente.nome_componente) AS componentes,
            usuario_reclamacao.nome_usuario AS nome_usuario_reclamacao, 
            usuario_reclamacao.login AS login_reclamacao, 
            usuario_reclamacao.nivelacesso_fk AS nivelacesso_fk_reclamacao';

            $where = "
             (manutencao.datahora_manutencao BETWEEN '$dataInicio' AND '$dataFim')
            AND manutencao.codusuario_fk = $usuario
            AND laboratorio.codlaboratorio = $laboratorio
            AND computador.codcomputador = $computador";

            $join = '
            INNER JOIN usuario AS usuario_manutencao ON manutencao.codusuario_fk = usuario_manutencao.codusuario 
            LEFT JOIN reclamacao ON manutencao.codreclamacao_fk = reclamacao.codreclamacao 
            LEFT JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador 
            LEFT JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
            LEFT JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
            LEFT JOIN componente ON reclamacao_componente.codcomponente_fk = componente.codcomponente 
            LEFT JOIN usuario AS usuario_reclamacao ON reclamacao.codusuario_fk = usuario_reclamacao.codusuario';
        }

        return (new Database('manutencao'))->select($where, null, null, null, $fields, $join)->fetchAll();
    }
}