<?php

namespace app\Infrastructure\DataBase\Reclamacao;

use app\Domain\Entity\Reclamacao;
use app\Domain\Repository\Reclamacao\BuscarReclamacaoPorComputadorRepository;
use WilliamCosta\DatabaseManager\Database;

class BuscarReclamacaoPorComputadorDao implements BuscarReclamacaoPorComputadorRepository
{
    public function buscarReclamacao($codcomputador): ?Reclamacao
    {
        $where = "reclamacao.codcomputador_fk = $codcomputador";
        $join = 'INNER JOIN usuario ON reclamacao.codusuario_fk = usuario.codusuario 
            INNER JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
            INNER JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador 
            INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
            INNER JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
            INNER JOIN componente ON componente.codcomponente = reclamacao_componente.codcomponente_fk
            INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';
        $fields = 'reclamacao.*, usuario.login, usuario.nome_usuario, usuario.email_usuario, 
                laboratorio.numerolaboratorio, computador.patrimonio, situacao.codsituacao, 
                situacao.tiposituacao,nivel_acesso.codnivel_acesso, nivel_acesso.tipo_acesso, 
                GROUP_CONCAT(componente.nome_componente SEPARATOR \', \') AS componentes';

        $result = (new Database('reclamacao'))->select($where, null, 1, null, $fields, $join)->fetch();

        if (empty($result) || in_array(null, $result, true)) {
            return null;
        }

        return Reclamacao::factoryReclamacao($result);
    }

}