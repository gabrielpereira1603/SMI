<?php

namespace app\Application\UseCase\Usuario\Aluno\CriarConta;

use app\Domain\Exceptions\Usuario\ErrorAoCriarUsuarioException;
use app\Domain\Repository\Usuario\CriarUsuarioRepository;
use app\Domain\Repository\Usuario\ValidaDadosCriarUsuarioRepository;
use app\Infrastructure\Drivers\PHPMailer\EmailSender;
use app\Infrastructure\Http\Request;
use app\Presentation\Utilitarios\Email\CadastrarReclamacao\CadastroReclamacaoEmail;
use app\Presentation\Utilitarios\Email\CriaContaAluno\CriaContaEmail;

class CriarUsuarioAlunoUseCase
{

    private CriarUsuarioRepository $criarUsuarioRepository;
    private ValidaDadosCriarUsuarioRepository $validaDadosCriarUsuarioRepository;


    public function __construct(
         CriarUsuarioRepository $criarUsuarioRepository,
         ValidaDadosCriarUsuarioRepository $validaDadosCriarUsuarioRepository
    )
    {
        $this->criarUsuarioRepository = $criarUsuarioRepository;
        $this->validaDadosCriarUsuarioRepository = $validaDadosCriarUsuarioRepository;
    }

    public function execute(Request $request, array $dadosUsuario): bool
    {
        if ($this->validaDadosCriarUsuarioRepository->buscarPorLogin($dadosUsuario['login'])){
            throw new ErrorAoCriarUsuarioException("Login existente!");
        }

        if ($this->validaDadosCriarUsuarioRepository->buscarPorEmail($dadosUsuario['email'])){
            throw new ErrorAoCriarUsuarioException("Email existente!");
        }

        if ($this->validaDadosCriarUsuarioRepository->buscarPorNome($dadosUsuario['nome'])){
            throw new ErrorAoCriarUsuarioException("Nome existente!");
        }

        if (!$this->criarUsuario($request, $dadosUsuario)) {
            throw new ErrorAoCriarUsuarioException("Não foi possível cadastrar usuário!");
        }

        if (!empty($dadosUsuario['email'])){
            $cadastroReclamacaoEmail = new CriaContaEmail();
            $cadastroReclamacaoEmail->enviarEmailBoasVindas($dadosUsuario['nome'],$dadosUsuario['email']);
        }
        return true;
    }

    private function criarUsuario(Request $request, array $dadosUsuario): bool
    {
        return $this->criarUsuarioRepository->criarUsuario($request, $dadosUsuario);
    }

}
