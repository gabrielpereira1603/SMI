<?php

namespace app\Application\UseCase\Manutencao;

use app\Infrastructure\Dao\Computador\ComputadorDao;
use app\Infrastructure\Dao\Manutencao\ManutencaoDao;
use app\Infrastructure\Dao\Reclamacao\ReclamacaoDao;

class InserirManutencaoUseCase
{
    public const CAMPOS_VAZIO = 1;
    public const SUCESSO_INSERT = 2;

    public const ERROR_INSERT = 3;

    public function insereManutencao($descricao,$codreclamacao,$codcomputador): int
    {
        $userData = $_SESSION['admin']['usuario'];
        $codUsuario = $userData['codusuario'];

        if (empty($descricao) || empty($codreclamacao) || empty($codcomputador)) {
            return self::CAMPOS_VAZIO;
        }

        $manutencaoDao = new ManutencaoDAO();
        if ($manutencaoDao->createManutencao($descricao,$codUsuario,$codreclamacao)){
            $reclamacaoDao = new ReclamacaoDao();
            $reclamacaoDao->updateReclamacao($codreclamacao, ['status' => 'Concluída']);
            $computadorDao = new ComputadorDao();
            $computadorDao->updateComputador($codcomputador, ['codsituacao_fk' => '1']);
            return self::SUCESSO_INSERT;
        }else{
            return self::ERROR_INSERT;
        }
    }
}