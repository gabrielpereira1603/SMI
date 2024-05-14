<?php

namespace app\Presentation\Controller\Aluno\RedefinirSenha;

use app\Domain\Exceptions\Usuario\UsuarioNaoEncontradoException;
use app\Domain\Repository\Usuario\BuscarTokenUsuarioRepository;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Session\RedefinirSenha\SessionRedefinirSenha;
use app\Presentation\Controller\Aluno\Page;
use app\Utils\View;

class ValidaToken extends Page
{
    private BuscarTokenUsuarioRepository $buscarTokenUsuarioRepository;

    public function __construct(BuscarTokenUsuarioRepository $buscarTokenUsuarioRepository)
    {
        $this->buscarTokenUsuarioRepository = $buscarTokenUsuarioRepository;
    }

    public static function getViewValidaToken($request): bool|array|string
    {
        $content = View::render('aluno/modules/redefinirSenha/validaToken',[

        ]);
        return parent::getPage('Valida Token',$content);
    }

    public function validaToken(Request $request)
    {
        $postVars = $request->getPostVars();

        $obUsuario = $this->buscarTokenUsuarioRepository->buscarToken($postVars['token']);
        if(!$obUsuario)
        {
            SessionRedefinirSenha::logout();
            $request->getRouter()->redirect('/login');
        }

        if ($obUsuario->getToken() != $postVars['token']){
            SessionRedefinirSenha::logout();
            $request->getRouter()->redirect('/login');
        }

        $request->getRouter()->redirect('/aluno/redefinirSenha');
    }

}