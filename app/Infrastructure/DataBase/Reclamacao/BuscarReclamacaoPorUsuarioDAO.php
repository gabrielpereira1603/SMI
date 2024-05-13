<?php

namespace app\Infrastructure\DataBase\Reclamacao;

use app\Domain\Entity\Computador;
use app\Domain\Entity\Laboratorio;
use app\Domain\Entity\NivelAcesso;
use app\Domain\Entity\Reclamacao;
use app\Domain\Entity\Situacao;
use app\Domain\Entity\Usuario;
use app\Domain\Repository\Reclamacao\BuscarReclamacaoPorAlunoRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarReclamacaoPorUsuarioDAO implements BuscarReclamacaoPorAlunoRepository
{

    public function buscarReclamacao(Request $request, $codusuario, $statusReclamacao): ?array
    {

        $where = "reclamacao.codusuario_fk = $codusuario AND reclamacao.status = '$statusReclamacao' GROUP BY reclamacao.codreclamacao";
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

        $result = (new Database('reclamacao'))->select($where, null, null, null, $fields, $join)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $reclamacoes = [];
        foreach ($result as $reclamacaoData) {
            $reclamacao = Reclamacao::factoryReclamacao($reclamacaoData);

            $reclamacoes[] = $reclamacao;
        }

        return $reclamacoes;
    }
}