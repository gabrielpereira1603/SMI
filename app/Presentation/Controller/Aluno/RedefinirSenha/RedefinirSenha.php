<?php

namespace app\Presentation\Controller\Aluno\RedefinirSenha;

use app\Application\UseCase\Usuario\RedefinirSenhaUsuarioUseCase;
use app\Domain\Exceptions\Usuario\ErrorAoRedefinirSenhaException;
use app\Infrastructure\DataBase\Usuario\RedefinirSenhaUsuarioDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Aluno\Page;
use app\Utils\View;

class RedefinirSenha extends Page
{
    public static function getViewRedefinirSenha($request): bool|array|string
    {
        $content = View::render('aluno/modules/redefinirSenha/index',[

        ]);
        return parent::getPage('Login Aluno',$content);
    }

    public static function redefinirSenha(Request $request)
    {
        try {
            $postVars = $request->getPostVars();

            $useCase = new RedefinirSenhaUsuarioUseCase(
                new RedefinirSenhaUsuarioDAO()
            );

            $useCase->execute($request,$postVars['senha']);
            $request->getRouter()->redirect('/login?success='. urlencode('Senha redefinida com sucesso!'));
        }catch (ErrorAoRedefinirSenhaException $e){
            $request->getRouter()->redirect('/login?error=' . urlencode($e->getMessage()));
        }
    }
}