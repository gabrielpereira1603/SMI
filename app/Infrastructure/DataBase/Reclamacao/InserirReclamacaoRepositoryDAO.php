<?php

namespace app\Infrastructure\DataBase\Reclamacao;

use app\Domain\Repository\Reclamacao\CadastrarReclamacaoRepository;
use WilliamCosta\DatabaseManager\Database;

class InserirReclamacaoRepositoryDAO implements CadastrarReclamacaoRepository
{
    public function cadastrarReclamacao(array $dadosReclamacao, $foto): int
    {
        $datahora_reclamacao = date("Y-m-d H:i:s");

        $userData = $_SESSION['aluno']['usuario'];
        $codUsuario = $userData['codusuario'];
        $database = new Database('reclamacao');
        return $database->insert([
            'descricao' => $dadosReclamacao['descricao'],
            'status' => 'Aberta',
            'datahora_reclamacao' => $datahora_reclamacao,
            'codcomputador_fk' => $dadosReclamacao['codcomputador'],
            'codlaboratorio_fk' => $dadosReclamacao['codlaboratorio'],
            'codusuario_fk' => $codUsuario,
            'imagem' => $foto[0]
        ]);
    }
}