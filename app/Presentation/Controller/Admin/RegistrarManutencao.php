<?php

namespace app\Presentation\Controller\Admin;

use app\Application\UseCase\Manutencao\InserirManutencaoUseCase;
use app\Application\UseCase\Reclamacao\BuscarDadosReclamacaoUseCase;
use app\Presentation\Utilitarios\Componentes\Carrousel\carrouselFotosReclamacao;
use app\Presentation\Utilitarios\Componentes\CheckBox\checkBoxSelected;
use app\Utils\View;

class RegistrarManutencao extends Page
{
    public static function getManutencao($request, $codcomputador): string
    {
        $useCase = new BuscarDadosReclamacaoUseCase();
        $data = $useCase->getDataReclamacao($codcomputador);

        $carrouselFoto = carrouselFotosReclamacao::getFotosView($data['codreclamacao']);
        $componentesSelected = checkBoxSelected::getComponentesView($data['codreclamacao']);

        $content = View::render('admin/modules/inserirManutencao/index', [
            'nav' => parent::getNav($request),
            'codreclamacao' => $data['codreclamacao'],
            'descricao'   => $data['descricao'],
            'status'   => $data['status'],
            'dataHora'   => $data['dataHora'],
            'numerolaboratorio' => $data['numerolaboratorio'],
            'patrimonio' => $data['patrimonio'],
            'nome_usuario' => $data['nome_usuario'],
            'email_usuario' => $data['email_usuario'],
            'login' => $data['login'],
            'componentes' => $componentesSelected,
            'foto' => $carrouselFoto
         ]);

        return parent::getPage('Manutenção', $content);
    }

    public static function setManutencao($request, $codcomputador): void
    {
        $postVars = $request->getPostVars();
        $descricao = $postVars['descricao'] ?? '';
        $codreclamacao= $postVars['codreclamacao'] ?? '';

        $manutencaoUseCase = new InserirManutencaoUseCase();
        $data = $manutencaoUseCase->insereManutencao($descricao,$codreclamacao,$codcomputador);

        if ($data === InserirManutencaoUseCase::CAMPOS_VAZIO){
            $request->getRouter()->redirect('/admin?success=camposVazios');
        }else if ($data === InserirManutencaoUseCase::ERROR_INSERT) {
            $request->getRouter()->redirect('/admin?success=manuntencaoNot');
        }else {
            $request->getRouter()->redirect('/admin?success=manutencaoAdd');
        }
    }
}