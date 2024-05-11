<?php

namespace app\Application\UseCase\Usuario\Aluno\CriarConta;

use app\Domain\Exceptions\Usuario\ErrorAoCriarUsuarioException;
use app\Domain\Repository\Usuario\CriarUsuarioRepository;
use app\Domain\Repository\Usuario\ValidaDadosCriarUsuarioRepository;
use app\Infrastructure\Http\Request;
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

        if (!empty($dadosUsuario['email'])) {
            return $this->enviarEmailBoasVindas($dadosUsuario['nome'], $dadosUsuario['email']);
        }

        return true;
    }

    private function criarUsuario(Request $request, array $dadosUsuario): bool
    {
        return $this->criarUsuarioRepository->criarUsuario($request, $dadosUsuario);
    }

    private function enviarEmailBoasVindas(string $nome, string $email): bool
    {
        return (new CriaContaEmail())->enviarEmailBoasVindas($nome, $email);
    }
}
