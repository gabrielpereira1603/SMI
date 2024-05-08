<?php

namespace app\Presentation\Utilitarios\Componentes\Table;

use app\Application\UseCase\Reclamacao\BuscarReclamacaoPorAlunoUseCase;
use app\Application\UseCase\ReclamacaoComponente\BuscarComponentePorReclamacaoUseCase;
use app\Infrastructure\DataBase\Reclamacao\BuscarReclamacaoPorUsuarioDAO;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Request;
use app\Utils\View;

class TableReclamacoesAbertas
{
    private BuscarReclamacaoPorUsuarioDAO $buscarReclamacaoPorUsuarioDAO;
    private BuscarComponentePorReclamacaoDAO $buscarComponentePorReclamacaoDAO;

    public function __construct(
        BuscarReclamacaoPorUsuarioDAO $buscarReclamacaoPorUsuarioDAO,
        BuscarComponentePorReclamacaoDAO $buscarComponentePorReclamacaoDAO
    )
    {
        $this->buscarReclamacaoPorUsuarioDAO = $buscarReclamacaoPorUsuarioDAO;
        $this->buscarComponentePorReclamacaoDAO = $buscarComponentePorReclamacaoDAO;

    }


    public function getTableReclamacaoAberta(Request $request): string
    {
        $userData = $_SESSION['aluno']['usuario'];
        $codusuario = $userData['codusuario'];

        $useCase = new BuscarReclamacaoPorAlunoUseCase(
            $this->buscarReclamacaoPorUsuarioDAO
        );

        $componenteUseCase = new BuscarComponentePorReclamacaoUseCase(
            $this->buscarComponentePorReclamacaoDAO
        );

        $obReclamacao = $useCase->execute($request,$codusuario);


        foreach ($obReclamacao as $reclamacao) {
            $codreclamacao = $reclamacao->getCodreclamacao();
            $obComponentes = $componenteUseCase->execute($request, $codreclamacao);
            $content .= View::render('aluno/modules/reclamacoesAbertas/itensTable', [
                'codreclamacao' => $reclamacao->getCodreclamacao(),
                'descricao' => $reclamacao->getDescricao(),
                'status' => $reclamacao->getStatus(),
                'patrimonio' => $reclamacao->getComputador()->getPatrimonio(),
                'numerolaboratorio' => $reclamacao->getLaboratorio()->getNumerolaboratorio(),
                'nome_usuario' => $reclamacao->getUsuario()->getNomeUsuario(),
                'datahora_reclamacao' => $reclamacao->getDataHoraReclamacao()->format('Y-m-d H:i:s'),
                'nome_componente' =>  $this->getNomesComponentes($obComponentes),
            ]);
        }

        return $content;
    }


    public function getNomesComponentes(?array $componentes): string
    {
        $nomesComponentes = [];

        if (is_array($componentes)) {
            foreach ($componentes as $componente) {
                $nomesComponentes[] = $componente->getNomeComponente();
            }
        }

        return implode(', ', $nomesComponentes);
    }
}