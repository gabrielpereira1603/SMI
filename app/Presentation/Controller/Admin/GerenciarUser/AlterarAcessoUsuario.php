<?php

namespace app\Presentation\Controller\Admin\GerenciarUser;

use app\Application\UseCase\Usuario\Admin\AtualizaAcessoUsuarioUseCase;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectNivelAcesso;
use app\Presentation\Utilitarios\Componentes\Select\SelectTodosUsuarios;
use app\Presentation\Utilitarios\Componentes\Table\UsuarioSemPermissao;
use app\Utils\View;

class AlterarAcessoUsuario extends Page
{
    public static function getAcesso($request): string
    {
        $nivelAcesso = SelectNivelAcesso::getNivelAcesso($request);
        $usuarioSemAcesso = UsuarioSemPermissao::NotPermissao($request);
        $todosUsuarios = SelectTodosUsuarios::getAll($request);

        $content = View::render('admin/modules/gerenciarUser/acessoUser', [
            'nivel_acesso' => $nivelAcesso,
            'not-permissao' => $usuarioSemAcesso,
            'usuarios' => $todosUsuarios
        ]);
        return parent::getPanel('Permissões de Usuários', $content, 'user');
    }

    public static function setAcesso($request): void
    {
        ['codusuario' => $codusuario, 'nivel_acesso' => $nivelAcesso] = $request->getPostVars();

        $alterarAcessoUseCase = new AtualizaAcessoUsuarioUseCase();
        $data = $alterarAcessoUseCase->validaDadosUsuario($codusuario,$nivelAcesso);

        if ($data === AtualizaAcessoUsuarioUseCase::SUCESSO) {
            $request->getRouter()->redirect('/admin/user/acesso?success=Permissão alterada com sucesso!');
        } else if ($data === AtualizaAcessoUsuarioUseCase::ERROR) {
            $request->getRouter()->redirect('/admin/user/acesso?error=Sem permissão.');
        } else if ($data === AtualizaAcessoUsuarioUseCase::NIVEL_ACESSO_NULL){
            $request->getRouter()->redirect('/admin/user/acesso?error=Campos Vazios, Preencha todos os campos!');
        }else{
            $request->getRouter()->redirect('/admin/user/acesso?error=Sem permissã.');
        }
    }
}