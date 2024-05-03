<?php

namespace app\Utils\Componentes\Table;

use app\Model\Dao\Reclamacao\ReclamacaoDao;
use app\Utils\View;

class TableReclamacoesAbertas
{
    public static function getTableReclamacaoAberta($request): string
    {
        $userData = $_SESSION['aluno']['usuario'];
        $codusuario = $userData['codusuario'];
        $dataReclamacao = (new ReclamacaoDao())->getReclamacoesAbertas($codusuario);

        $content = '';

        foreach ($dataReclamacao as $reclamacao) {
            $content .= View::render('aluno/modules/reclamacoesAbertas/itensTable', [
                'codreclamacao' => $reclamacao['codreclamacao'],
                'descricao' => $reclamacao['descricao'],
                'status' => $reclamacao['status'],
                'patrimonio' => $reclamacao['patrimonio'],
                'numerolaboratorio' => $reclamacao['numerolaboratorio'],
                'nome_usuario' => $reclamacao['nome_usuario'],
                'nome_componente' => $reclamacao['componentes'],
                'datahora_reclamacao' => $reclamacao['datahora_reclamacao'],
            ]);
        }

        return $content;
    }
}