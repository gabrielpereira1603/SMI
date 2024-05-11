<?php

namespace app\Presentation\Controller\Aluno\CriarConta;

use app\Application\UseCase\NivelAcesso\BuscarNivelAcessoPorTipoUseCase;
use app\Application\UseCase\Usuario\Aluno\CriarConta\CriarUsuarioAlunoUseCase;
use app\Domain\Exceptions\Usuario\ErrorAoCriarUsuarioException;
use app\Domain\Handler\ValidaDadosCriarUsuario\ValidaDadosCriarUsuarioHandlerChain;
use app\Infrastructure\DataBase\NivelAcesso\BuscarNivelAcessoPorTipoDAO;
use app\Infrastructure\DataBase\Usuario\CriarUsuarioDAO;
use app\Infrastructure\DataBase\Usuario\ValidaDadosCriarUsuarioDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Aluno\Page;
use app\Utils\View;

class CriarConta extends Page
{
    public static function getViewCriarConta(Request $request): string
    {
        $useCase = new BuscarNivelAcessoPorTipoUseCase(
            new BuscarNivelAcessoPorTipoDAO()
        );
        $obNivelAcesso = $useCase->execute($request,"Aluno");
        $content .= View::render('aluno/criarConta/index',[
            'codnivel_acesso' => $obNivelAcesso->getCodNivelAcesso(),
            'tipo_acesso' => $obNivelAcesso->getTipoAcesso(),
        ]);

        return parent::getPage('Criar Conta',$content);
    }

    public static function setNovoUsuarioAluno(Request $request): void
    {
        try {
            $dadosUsuario = [
                'nome' => $nome,
                'email' => $email,
                'login' => $login,
                'senha' => $senha,
                'codnivel_acesso' => $codnivel_acesso,
                'tipo_acesso' => $tipo_acesso,
            ] = $request->getPostVars();

            $useCase = new CriarUsuarioAlunoUseCase(
                new CriarUsuarioDAO(),
                new ValidaDadosCriarUsuarioDAO()
            );

            $useCase->execute($request, $dadosUsuario);

            $request->getRouter()->redirect('/login?success=' . urlencode("Usuário cadastrado com sucesso!"));
        } catch (ErrorAoCriarUsuarioException $e) {
            $request->getRouter()->redirect('/login?error=' . urlencode($e->getMessage()));
        }
    }
}