<?php

namespace app\Application\UseCase\Usuario;

use app\Domain\Exceptions\Usuario\GerarTokenRedefinirSenhaException;
use app\Domain\Exceptions\Usuario\UsuarioNaoEncontradoException;
use app\Domain\Repository\Usuario\BuscarUsuarioPorEmailRepository;
use app\Domain\Repository\Usuario\GerarTokenRedefinirSenharRepository;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Session\RedefinirSenha\SessionRedefinirSenha;
use app\Presentation\Utilitarios\Email\GerarTokenRedefinirSenha\EnviarEmailTokenRedefinirSenha;

class GerarTokenRedefinirSenhaUseCase
{
    private GerarTokenRedefinirSenharRepository $gerarTokenRedefinirSenharRepository;
    private BuscarUsuarioPorEmailRepository $buscarUsuarioPorEmailRepository;

    public function __construct(
        GerarTokenRedefinirSenharRepository $gerarTokenRedefinirSenharRepository,
        BuscarUsuarioPorEmailRepository $buscarUsuarioPorEmailRepository
    )
    {
        $this->gerarTokenRedefinirSenharRepository = $gerarTokenRedefinirSenharRepository;
        $this->buscarUsuarioPorEmailRepository = $buscarUsuarioPorEmailRepository;
    }

    public function execute(Request $request, $email)
    {
        $token = $this->gerarToken(5);

        $usuario = $this->buscarUsuarioPorEmailRepository->buscarPorEmail($email);
        if (!$usuario) {
            throw new UsuarioNaoEncontradoException("Não foi possível encontrar o usuário!");
        }

        $codusuario = $usuario->getCodusuario();
        $nome = $usuario->getNomeUsuario();

        if (!$this->gerarTokenRedefinirSenharRepository->gerarToken($codusuario, ['token' => $token])){
            throw new GerarTokenRedefinirSenhaException("Não foi possível gerar o Token!");
        }

        $cadastroReclamacaoEmail = new EnviarEmailTokenRedefinirSenha();
        $cadastroReclamacaoEmail->enviarEmailToken($nome,$token,$email);

        SessionRedefinirSenha::iniciaSessao($usuario);
    }

    private function gerarToken(int $length): string
    {
        $characters = '0123456789';
        $token = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, $max)];
        }
        return $token;
    }
}