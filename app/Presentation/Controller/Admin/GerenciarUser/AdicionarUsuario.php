<?php

namespace app\Presentation\Controller\Admin\GerenciarUser;

use app\Application\UseCase\Usuario\Admin\CriarUsuarioUseCase;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectNivelAcesso;
use app\Utils\View;

class AdicionarUsuario extends Page
{
    public static function getNewUser($request): string
    {
        $nivelAcesso = SelectNivelAcesso::getNivelAcesso($request);
        $content = View::render('admin/modules/gerenciarUser/addUser', [
            'status' => $status,
            'nivel_acesso' => $nivelAcesso
        ]);

        return parent::getPanel('Adicionar Usuário', $content, 'user');
    }

    public static function setNewUser($request): void
    {
        ['login' => $login,
        'email' => $email,
        'nome' => $nome,
        'nivel_acesso' => $nivel_acesso,
        'senha' => $senha
        ] = $request->getPostVars();

        $criaUserUseCase = (new CriarUsuarioUseCase())->validaDadosUsuario($login,$email,$nome,$nivel_acesso,$senha);
        if ($criaUserUseCase === CriarUsuarioUseCase::SUCESSO){
            $request->getRouter()->redirect('/admin/user/add?success=add');
        }else{
            $request->getRouter()->redirect('/admin/user/add?error=not');
        }
    }
}