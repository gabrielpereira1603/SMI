<?php

namespace app\Presentation\Controller\Admin\RegistrarManutencao;

use app\Application\UseCase\Reclamacao\BuscarReclamacaoPorComputadorUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Infrastructure\DataBase\Foto\BuscarFotoPorReclamacaoDAO;
use app\Infrastructure\DataBase\Reclamacao\BuscarReclamacaoPorComputadorDao;
use app\Infrastructure\DataBase\ReclamacaoComponente\BuscarComponentePorReclamacaoDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Carrousel\carrouselFotosReclamacao;
use app\Presentation\Utilitarios\Componentes\CheckBox\checkBoxSelected;
use app\Utils\View;

class ViewRegistrarManutencao extends Page
{
    public static function buscarDadosReclamacao(Request $request, $codcomputador)
    {
        $obReclamacao = (new BuscarReclamacaoPorComputadorUseCase(new BuscarReclamacaoPorComputadorDao()))->execute($request,$codcomputador);

        $componentesSelected = (
            new checkBoxSelected(
                new BuscarComponentePorReclamacaoDAO()))->getComponentesView($request,$obReclamacao->getCodreclamacao()
            )
        ;

        $content = View::render('admin/modules/inserirManutencao/index', [
            'nav' => parent::getNav($request),
            'codreclamacao' => $obReclamacao->getCodreclamacao(),
            'descricao'   => $obReclamacao->getDescricao(),
            'status'   => $obReclamacao->getStatus(),
            'dataHora'   => $obReclamacao->getDataHoraReclamacao()->format('d/m/Y H:i:s'),
            'numerolaboratorio' => $obReclamacao->getLaboratorio()->getNumeroLaboratorio(),
            'patrimonio' => $obReclamacao->getComputador()->getPatrimonio(),
            'nome_usuario' => $obReclamacao->getUsuario()->getNomeUsuario(),
            'email_usuario' => $obReclamacao->getUsuario()->getEmailUsuario(),
            'login' => $obReclamacao->getUsuario()->getLogin(),
            'componentes' => $componentesSelected,
            'foto' => $obReclamacao->getImagem(), // Aqui está a string base64 diretamente do banco
        ]);

        return parent::getPage('Registrar Reclamação',$content);
    }

}