<?php

namespace app\Infrastructure\DataBase\Usuario;

use app\Domain\Entity\NivelAcesso;
use app\Domain\Entity\Usuario;
use app\Domain\Repository\Usuario\ValidaDadosCriarUsuarioRepository;
use WilliamCosta\DatabaseManager\Database;

class ValidaDadosCriarUsuarioDAO implements ValidaDadosCriarUsuarioRepository
{

    public function buscarPorLogin(string $login): ?Usuario
    {
        $where = "usuario.login = '$login'";
        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';

        $result = (new Database('usuario'))->select($where, null, null, null, '*', $join)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $usuarioData = $result[0];

        $nivelAcesso = new NivelAcesso($usuarioData['codnivel_acesso'], $usuarioData['tipo_acesso']);

        return new Usuario(
            $usuarioData['codusuario'],
            $usuarioData['nome'],
            $usuarioData['email'],
            $usuarioData['login'],
            $usuarioData['senha'],
            '',
            $nivelAcesso
        );
    }

    public function buscarPorEmail(string $email): ?Usuario
    {
        $where = "usuario.email = '$email'";
        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';

        $result = (new Database('usuario'))->select($where, null, null, null, '*', $join)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $usuarioData = $result[0];

        $nivelAcesso = new NivelAcesso($usuarioData['codnivel_acesso'], $usuarioData['tipo_acesso']);

        return new Usuario(
            $usuarioData['codusuario'],
            $usuarioData['nome'],
            $usuarioData['email'],
            $usuarioData['login'],
            $usuarioData['senha'],
            '',
            $nivelAcesso
        );
    }

    public function buscarPorNome(string $nome): ?Usuario
    {
        $where = "usuario.nome = '$nome'";
        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';

        $result = (new Database('usuario'))->select($where, null, null, null, '*', $join)->fetchAll();

        if (empty($result)) {
            return null;
        }

        $usuarioData = $result[0];

        $nivelAcesso = new NivelAcesso($usuarioData['codnivel_acesso'], $usuarioData['tipo_acesso']);

        return new Usuario(
            $usuarioData['codusuario'],
            $usuarioData['nome'],
            $usuarioData['email'],
            $usuarioData['login'],
            $usuarioData['senha'],
            '',
            $nivelAcesso
        );
    }
}