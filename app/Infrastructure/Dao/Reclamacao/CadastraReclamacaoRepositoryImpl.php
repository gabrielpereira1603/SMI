<?php

namespace app\Infrastructure\Dao\Reclamacao;

use app\Domain\Service\Reclamacao\CadastrarReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class CadastraReclamacaoRepositoryImpl implements CadastrarReclamacaoRepository
{
    public function cadastrarReclamacao(array $dadosReclamacao): int
    {
        $datahora_reclamacao = date("Y-m-d H:i:s");

        $userData = $_SESSION['aluno']['usuario'];
        $codUsuario = $userData['codusuario'];
        $database = new Database('reclamacao');

        $lastIdReclamacao = $database->insert([
            'descricao' => $dadosReclamacao['descricao'],
            'prazo_reclamacao' => 1,
            'status' => 'Em aberto',
            'datahora_reclamacao' => $datahora_reclamacao,
            'datahora_fimreclamacao' => '',
            'codcomputador_fk' => $dadosReclamacao['codcomputador'],
            'codlaboratorio_fk' => $dadosReclamacao['codlaboratorio'],
            'codusuario_fk' => $codUsuario
        ]);

        return $lastIdReclamacao;
    }
}