<?php

namespace app\Presentation\Controller\Admin\RegistrarManutencao;

use app\Application\UseCase\Computador\BuscarComputadorPorIdUseCase;
use app\Application\UseCase\Reclamacao\BuscarReclamacaoPorComputadorUseCase;
use app\Domain\Entity\Reclamacao;
use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\DataBase\Situacao\BuscarTodasSituacaoDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\CheckBox\checkBoxSelected;
use app\Presentation\Utilitarios\Componentes\Select\SelectSituacoesComputador;
use app\Utils\View;

class ViewRegistrarManutencao extends Page
{
    private BuscarReclamacaoPorComputadorUseCase $buscarReclamacaoPorComputador;
    private BuscarComputadorPorIdUseCase $buscarComputadorPorIdUseCase;

    public function __construct(
        BuscarReclamacaoPorComputadorUseCase $buscarReclamacaoPorComputador,
        BuscarComputadorPorIdUseCase $buscarComputadorPorIdUseCase
    )
    {
        $this->buscarReclamacaoPorComputador = $buscarReclamacaoPorComputador;
        $this->buscarComputadorPorIdUseCase = $buscarComputadorPorIdUseCase;
    }

    public function buscarDadosReclamacao(Request $request, $codcomputador)
    {
        try {
            $obReclamacao = $this->buscarReclamacaoPorComputador->execute($request,$codcomputador);
            return $this->renderPageSucesso($request,$obReclamacao);
        } catch (ReclamacoesNaoEncontradasExceptions $e) {
            return $this->renderPageFalha($request, $e->getMessage(), $codcomputador);
        }
    }
    private function renderPageSucesso(Request $request, Reclamacao $obReclamacao)
    {
        $componentesSelected = (
        new checkBoxSelected(
            new BuscarComponentePorReclamacaoDAO()))->getComponentesView($request,$obReclamacao->getCodreclamacao()
            )
        ;

        $classIconBtn = $this->classIconBtn($obReclamacao->getComputador()->getSituacao()->getTipoSituacao());

        $content = View::render('admin/modules/inserirManutencao/index', [
            'nav' => parent::getNav($request),
            'codreclamacao' => $obReclamacao->getCodreclamacao(),
            'codcomputador' => $obReclamacao->getComputador()->getCodcomputador(),
            'descricao' => $obReclamacao->getDescricao(),
            'status' => $obReclamacao->getStatus(),
            'dataHora' => $obReclamacao->getDataHoraReclamacao()->format('d/m/Y H:i:s'),
            'numerolaboratorio' => $obReclamacao->getLaboratorio()->getNumeroLaboratorio(),
            'patrimonio' => $obReclamacao->getComputador()->getPatrimonio(),
            'classIcon' => $classIconBtn['classIcon'],
            'classBtn' => $classIconBtn['classBtn'],
            'tipo_situacao' => $obReclamacao->getComputador()->getSituacao()->getTipoSituacao(),
            'nome_usuario' => $obReclamacao->getUsuario()->getNomeUsuario(),
            'email_usuario' => $obReclamacao->getUsuario()->getEmailUsuario(),
            'login' => $obReclamacao->getUsuario()->getLogin(),
            'componentes' => $componentesSelected,
            'foto' => $obReclamacao->getImagem(),
            'todas_situacao' => $this->buscarTodasSituacao($request)
        ]);

        return parent::getPage('Registrar Reclamação', $content);
    }

    private function renderPageFalha(Request $request, string $mensagem, int $codcomputador)
    {
        $obComputador = $this->buscarComputadorPorIdUseCase->execute($codcomputador,$request);

        $classIconBtn = $this->classIconBtn($obComputador->getSituacao()->getTipoSituacao());

        $contentData = [
            'codreclamacao', 'descricao', 'status', 'dataHora', 'numerolaboratorio',
            'nome_usuario', 'email_usuario', 'login', 'componentes', 'foto',
        ];

        $content = array_fill_keys($contentData, $mensagem);
        $content['patrimonio'] = $obComputador->getPatrimonio();
        $content['codcomputador'] = $obComputador->getCodcomputador();
        $content['nav'] = parent::getNav($request);
        $content['btnActive'] = 'disabled';
        $content['classIcon'] = $classIconBtn['classIcon'];
        $content['classBtn'] = $classIconBtn['classBtn'];
        $content['tipo_situacao'] = $obComputador->getSituacao()->getTipoSituacao();
        $content['todas_situacao'] = $this->buscarTodasSituacao($request);

        $content = View::render('admin/modules/inserirManutencao/index', $content);

        return parent::getPage('Registrar Manutenção', $content);
    }

    private function buscarTodasSituacao(Request $request)
    {
        return (new SelectSituacoesComputador(new BuscarTodasSituacaoDAO()))->buscarSituacao($request);
    }

    private function classIconBtn(string $tipoSituacao)
    {
        $classBtn = '';

        switch ($tipoSituacao) {
            case "Disponivel":
                $classIcon = 'bi bi-check-circle-fill';
                $classBtn = 'btn-success';
                break;
            case "Em Manutenção":
                $classIcon = 'bi bi-tools';
                $classBtn = 'btn-warning';
                break;
            case "Indisponivel":
                $classIcon = 'bi bi-exclamation-octagon-fill';
                $classBtn = 'btn-danger';
                break;
            default:
                $classIcon = '';
                break;
        }

        return [
            'classIcon' => $classIcon,
            'classBtn' => $classBtn
        ];
    }
}