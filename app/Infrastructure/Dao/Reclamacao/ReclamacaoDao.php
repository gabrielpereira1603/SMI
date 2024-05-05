<?php

namespace app\Infrastructure\Dao\Reclamacao;

use app\Domain\Entity\Computador;
use app\Domain\Entity\Laboratorio;
use app\Domain\Entity\NivelAcesso;
use app\Domain\Entity\Reclamacao;
use app\Domain\Entity\Situacao;
use app\Domain\Entity\Usuario;
use app\Domain\Service\Reclamacao\ReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class ReclamacaoDao implements ReclamacaoRepository
{
    public function getDetalhesByComputador(string $codcomputador): ?Reclamacao
    {
        $where = "reclamacao.codcomputador_fk = $codcomputador AND reclamacao.status = 'Em aberto'";
        $join = 'INNER JOIN usuario ON reclamacao.codusuario_fk = usuario.codusuario
             INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso
             INNER JOIN laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio
             INNER JOIN computador ON reclamacao.codcomputador_fk = computador.codcomputador
             INNER JOIN situacao ON computador.codsituacao_fk = situacao.codsituacao
             INNER JOIN reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk
             INNER JOIN componente ON componente.codcomponente = reclamacao_componente.codcomponente_fk';
        $fields = 'reclamacao.*, 
               usuario.login, usuario.senha, usuario.nome_usuario, usuario.email_usuario, 
               nivel_acesso.codnivel_acesso, nivel_acesso.tipo_acesso,
               laboratorio.numerolaboratorio, 
               computador.patrimonio, computador.codsituacao_fk, computador.codlaboratorio_fk,
               situacao.tiposituacao,
               componente.nome_componente';

        $result = (new Database('reclamacao'))->select($where, null, null, null, $fields, $join)->fetchAll();
        if (empty($result)) {
            return null;
        }

        $reclamacaoData = $result[0];
        return $this->createDataReclamacao($reclamacaoData);
    }

    private function createDataReclamacao(array $reclamacaoData): Reclamacao
    {
        $dataHora_Reclamacao = new \DateTime($reclamacaoData['datahora_reclamacao']);
        $dataHora_fimReclamacao = new \DateTime($reclamacaoData['datahora_fimreclamacao']);
        $laboratorio = new Laboratorio($reclamacaoData['codlaboratorio_fk'], $reclamacaoData['numerolaboratorio']);
        $situacao = new Situacao($reclamacaoData['codsituacao_fk'], $reclamacaoData['tiposituacao']);
        $nivelAcesso = new NivelAcesso($reclamacaoData['codnivel_acesso'], $reclamacaoData['tipo_acesso']);

        $computador = new Computador(
            $reclamacaoData['codcomputador_fk'],
            $reclamacaoData['patrimonio'],
            $situacao,
            $laboratorio
        );

        $usuario = new Usuario(
            $reclamacaoData['codusuario_fk'],
            $reclamacaoData['nome_usuario'],
            $reclamacaoData['email_usuario'],
            $reclamacaoData['login'],
            $reclamacaoData['senha'],
            $nivelAcesso
        );

        $reclamacao = new Reclamacao(
            $reclamacaoData['codreclamacao'],
            $reclamacaoData['descricao'],
            $reclamacaoData['prazo_reclamacao'],
            $reclamacaoData['status'],
            $dataHora_Reclamacao,
            $dataHora_fimReclamacao,
            $computador,
            $laboratorio,
            $usuario,
        );

        return $reclamacao;
    }

    public function updateReclamacao(int $codreclamacao, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        $whereClause = "codreclamacao = $codreclamacao";
        $database = new Database('reclamacao');
        $result = $database->update($whereClause, $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getReclamacoesAbertas($codusuario)
    {
        $where = "reclamacao.codusuario_fk = $codusuario
        AND reclamacao.status = 'Em aberto' GROUP BY reclamacao.codreclamacao";

        $join = ' INNER JOIN 
            usuario ON reclamacao.codusuario_fk = usuario.codusuario 
        INNER JOIN 
            laboratorio ON reclamacao.codlaboratorio_fk = laboratorio.codlaboratorio 
        INNER JOIN 
            computador ON reclamacao.codcomputador_fk = computador.codcomputador 
        INNER JOIN 
            reclamacao_componente ON reclamacao.codreclamacao = reclamacao_componente.codreclamacao_fk 
        INNER JOIN 
            componente ON componente.codcomponente = reclamacao_componente.codcomponente_fk';

        // Ajuste aqui para usar GROUP_CONCAT
        $fields = 'reclamacao.*, usuario.login, usuario.nome_usuario, usuario.email_usuario, 
                    laboratorio.numerolaboratorio, computador.patrimonio, computador.codcomputador, 
                    GROUP_CONCAT(componente.nome_componente SEPARATOR \', \') AS componentes';

        $result = (new Database('reclamacao'))->select($where, null, null,null, $fields, $join)->fetchAll();

        if (empty($result)) {
            return null;
        }

        return $result;
    }
}