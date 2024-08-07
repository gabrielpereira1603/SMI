<?php

namespace app\Presentation\Controller\Admin\GerenciarUser;

use app\Application\UseCase\Usuario\Admin\CriarUsuarioUseCase;
use app\Application\UseCase\Usuario\Aluno\CriarConta\CriarUsuarioAlunoUseCase;
use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Domain\Exceptions\Usuario\ErrorAoCriarUsuarioException;
use app\Infrastructure\DataBase\Usuario\CriarUsuarioDAO;
use app\Infrastructure\DataBase\Usuario\ValidaDadosCriarUsuarioDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Presentation\Utilitarios\Componentes\Select\SelectNivelAcesso;
use app\Utils\View;

class AdicionarUsuario extends Page
{
    public static function getNewUser($request): string
    {
        $nivelAcesso = SelectNivelAcesso::getNivelAcesso($request);

        $content = View::render('admin/modules/gerenciarUser/addUser', [
            'nivel_acesso' => $nivelAcesso
        ]);

        return parent::getPanel('Adicionar Usuário', $content, 'user');
    }

    public static function setNewUser(Request $request): void
    {
        try {
            $requestData = $request->getPostVars();

            $hashedPassword = password_hash($requestData['senha'], PASSWORD_DEFAULT);

            $dadosUsuario = [
                'nome' => $requestData['nome'],
                'email' => $requestData['email'],
                'codnivel_acesso' => $requestData['codnivel_acesso'],
                'login' => $requestData['login'],
                'senha' => $hashedPassword
            ];

            $criaUserUseCase = (new CriarUsuarioAlunoUseCase(
                new CriarUsuarioDAO(),
                new ValidaDadosCriarUsuarioDAO()
            ))->execute($request,$dadosUsuario);

            $request->getRouter()->redirect('/admin/user/add?success=' . urlencode("Usuário cadastrado com sucesso!"));
        }catch (ErrorAoCriarUsuarioException | ErroAoEnviarEmailException $e){
            $request->getRouter()->redirect('/admin/user/add?error=' . urlencode($e->getMessage()));
        }


    }
}