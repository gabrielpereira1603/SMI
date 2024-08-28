<?php

namespace app\Presentation\Controller\Admin\GerenciarUser;

use app\Infrastructure\Dao\Usuario\UsuarioDao;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectTodosUsuarios;
use app\Utils\View;

class AlterarInformacoes extends Page
{
    public static function getUpdate($request) {
        $userData = $_SESSION['admin']['usuario'];
        $nomeUser = $userData['nome_usuario'];
        $tipo_acesso_Session = $userData['tipo_acesso'];
        $emailUser = $userData['email_usuario'];
        $loginUser = $userData['login'];


        $content = View::render('admin/modules/gerenciarUser/updateUser', [
            'nivel_acesso' => $tipo_acesso_Session,
            'nomeUser' => $nomeUser,
            'emailUser' => $emailUser,
            'loginUser' => $loginUser,
            'usuarios' => SelectTodosUsuarios::getAll($request),
        ]);

        return parent::getPanel('Alterar Usuários', $content, 'user');
    }


    public static function setUpdate($request)
    {
        $postVars = $request->getPostVars();
        $nome = $postVars['nome-input'] ?? '';
        $email = $postVars['email'] ?? '';
        $login = $postVars['login'] ?? '';

        if($login == null) {
            $request->getRouter()->redirect('/admin/user/update?success=prenchaLogin');
        }

        // Verifica se o usuário existe antes de tentar atualizá-lo
        $codUsuario = UsuarioDao::getByLogin($login);
        if ($codUsuario) {
            $result = UsuarioDao::setUpdateUser($login, $nome, $email);
            if ($result) {
                $request->getRouter()->redirect('/admin/user/update?success=Usuário alterado com sucesso!');
            } else {
                $request->getRouter()->redirect('/admin/user/update?error=Error ao alterar usuario!');
            }
        } else {
            $request->getRouter()->redirect('/admin/user/update?error=Usuário não existe!');
        }
    }
}