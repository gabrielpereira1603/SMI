<?php

namespace app\Infrastructure\DataBase\Reclamacao;

use app\Domain\Entity\Reclamacao;
use app\Domain\Repository\Reclamacao\BuscarReclamacaoPorIdRepository;
use WilliamCosta\DatabaseManager\Database;

class BuscarReclamacaoPorIdDAO implements BuscarReclamacaoPorIdRepository
{
    public function buscarPorId($codreclamacao): ?Reclamacao
    {
        $where = "reclamacao.codreclamacao = $codreclamacao";
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
        if ($this->isValidResult($result)) {
            return Reclamacao::factoryReclamacao($result);
        }

        return null;
    }

    private function isValidResult($result): bool
    {
        $mandatoryFields = [
            'codreclamacao', 'descricao', 'prazo_reclamacao', 'status', 'datahora_reclamacao',
            'codcomputador_fk', 'codlaboratorio_fk', 'codusuario_fk', 'login', 'nome_usuario',
            'email_usuario', 'numerolaboratorio', 'patrimonio', 'codsituacao', 'tiposituacao',
            'codnivel_acesso', 'tipo_acesso'
        ];

        foreach ($mandatoryFields as $field) {
            if (is_null($result[$field])) {
                return false;
            }
        }

        return true;
    }
}