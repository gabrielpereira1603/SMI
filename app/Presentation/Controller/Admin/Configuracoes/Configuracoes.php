<?php

namespace app\Presentation\Controller\Admin\Configuracoes;

use app\Infrastructure\Dao\Computador\ComputadorDao;
use app\Infrastructure\DataBase\Computador\EditarComputadorDAO;
use app\Infrastructure\DataBase\Laboratorio\AdicionarLaboratorioDAO;
use app\Infrastructure\DataBase\Laboratorio\EditarLaboratorioDAO;
use app\Infrastructure\DataBase\Laboratorio\ExcluirLaboratorioDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectTodosLaboratorios;
use app\Utils\View;

class Configuracoes extends Page
{
    public static function index(Request $request)
    {
        $content ='';

        $SelectTodosLaboratorios = SelectTodosLaboratorios::getLaboratorioItens($request);

        $content = View::render('admin/modules/configuracoes/index',[
            'selectLabs' => $SelectTodosLaboratorios,
        ]);

        //RETONA A PAGINA COMPLETA
        return parent::getPanel('Configurações', $content, 'gerenciar');
    }

    public static function addLab(Request $request)
    {
        // Obtém as variáveis POST
        $postVars = $request->getPostVars();

        // Verifica se o campo 'numerolaboratorio' está presente
        if (isset($postVars['numerolaboratorio']) && !empty($postVars['numerolaboratorio'])) {
            $nomeLaboratorio = $postVars['numerolaboratorio'];

            // Verifica se o número do laboratório é numérico
            if (!is_numeric($numerolaboratorio)) {
                $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O número do laboratório deve ser um número válido."));
                return;
            }

            // Chama a função adicionaLaboratorio para inserir o laboratório
            $inseridoComSucesso = AdicionarLaboratorioDAO::adicionaLaboratorio($request, $nomeLaboratorio);

            if ($inseridoComSucesso) {
                // Sucesso - redireciona com uma mensagem de sucesso
                $request->getRouter()->redirect('/admin/gerenciar?success=' . urlencode("Laboratório cadastrado com sucesso!"));
            } else {
                // Falha - redireciona com uma mensagem de erro
                $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro ao cadastrar o laboratório."));
            }
        } else {
            // Caso o nome do laboratório não tenha sido fornecido
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("O nome do laboratório é obrigatório."));
        }
    }

    public static function editarLabs(Request $request, $codlaboratorio)
    {
        $postVars = $request->getPostVars();

        if (isset($postVars['numerolaboratorio']) && !empty($postVars['numerolaboratorio'])) {
            $numerolaboratorio = $postVars['numerolaboratorio'];

            // Verifica se o número do laboratório é numérico
            if (!is_numeric($numerolaboratorio)) {
                $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O número do laboratório deve ser um número válido."));
                return;
            }

            // Verifica se o laboratório já está cadastrado
            if (EditarLaboratorioDAO::laboratorioJaCadastrado($numerolaboratorio)) {
                $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: Já existe um laboratório com o número fornecido."));
                return;
            }

            // Chama a função para editar o laboratório
            EditarLaboratorioDAO::editaLaboratorio($codlaboratorio, ['numerolaboratorio' => $numerolaboratorio]);
            $request->getRouter()->redirect('/admin/gerenciar?success=' . urlencode("Laboratório editado com sucesso!"));
        } else {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("O número do laboratório é obrigatório."));
        }
    }

    public static function editarComputador(Request $request){
        $postVars = $request->getPostVars();

        if (empty($postVars['patrimonio']) || empty($postVars['situacao']) || empty($postVars['computadorId'])) {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: Todos os campos são obrigatórios."));
            return;
        }

        if (!is_numeric($postVars['computadorId'])) {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O número do computador deve ser um número válido."));
            return;
        }

        if (!is_numeric($postVars['situacao'])) {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O código da situação deve ser um número válido."));
            return;
        }

        EditarComputadorDAO::editarComputador($postVars['computadorId'], [
            'codsituacao_fk' => $postVars['situacao'],
            'patrimonio' => $postVars['patrimonio']
        ]);

        $request->getRouter()->redirect('/admin/gerenciar?success=' . urlencode("Computador editado com sucesso!"));
    }

    public static function cadastrarComputador(Request $request)
    {
        $postVars = $request->getPostVars();

        if (empty($postVars['patrimonio']) || empty($postVars['situacao']) || empty($postVars['laboratorio'])) {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: Todos os campos são obrigatórios."));
            return;
        }

        if (!is_numeric($postVars['situacao'])) {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O código da situação deve ser um número válido."));
            return;
        }

        if (!is_numeric($postVars['laboratorio'])) {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O código do laboratório deve ser um número válido."));
            return;
        }

        $id = ComputadorDao::cadastrarComputador([
            'patrimonio' => $postVars['patrimonio'],
            'codsituacao_fk' => $postVars['situacao'],
            'codlaboratorio_fk' => $postVars['laboratorio']
        ]);

        if ($id) {
            $request->getRouter()->redirect('/admin/gerenciar?success=' . urlencode("Computador cadastrado com sucesso!"));
        } else {
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: Não foi possível cadastrar o computador."));
        }
    }

}