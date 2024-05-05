<?php

namespace app\Presentation\Controller\Aluno\CriarConta;

use app\Application\UseCase\Usuario\Aluno\CriarConta\CriarUsuarioAlunoUseCase;
use app\Domain\Exceptions\CriarUsuarioAluno\LoginOuEmailExistentes;
use app\Presentation\Controller\Aluno\Page;
use app\Utils\View;

class CriarConta extends Page
{
    public static function getViewCriarConta($request): string
    {
        $content .= View::render('aluno/criarConta/index',[

        ]);

        return parent::getPage('Criar Conta',$content);
    }

    public static function setNovoUsuarioAluno($request): void
    {
        [
            'nome' => $nome,
            'email' => $email,
            'login' => $login,
            'senha' => $senha,
        ] = $request->getPostVars();

        try {
            $useCase = new CriarUsuarioAlunoUseCase();
            $useCase->validaInformacoes($nome, $email, $login, $senha);
            $request->getRouter()->redirect('/aluno/novaConta?success='. urlencode('Usuário Cadastrado com Sucesso!'));
        } catch (LoginOuEmailExistentes $e){
            $request->getRouter()->redirect('/aluno/novaConta?error=' . urlencode($e->getMessage()));
        }
    }
}