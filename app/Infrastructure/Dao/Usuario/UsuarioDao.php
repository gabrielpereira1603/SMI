<?php

namespace app\Infrastructure\Dao\Usuario;

use app\Domain\Entity\NivelAcesso;
use app\Domain\Entity\Usuario;
use WilliamCosta\DatabaseManager\Database;

class UsuarioDao
{
    public function getByLogin(string $login): ?Usuario
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
    public function createUsuario($login,$email,$nome,$nivel_acesso,$senha): bool
    {
        $database = new Database('usuario');
        $idInserido = $database->insert([
            'login' => $login,
            'email' => $email,
            'nome' => $nome,
            'senha' => $senha,
            'nivelacesso_fk' => $nivel_acesso
        ]);

        if ($idInserido) {
            return true;
        } else {
            return false;
        }
    }
    public function getUsuarioSemPermissao(): array
    {
        $where = "usuario.nivelacesso_fk = 4";
        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';

        $results = (new Database('usuario'))->select($where, null, null, null, '*', $join)->fetchAll();

        $usuarios = [];
        foreach ($results as $usuarioData) {
            $nivelAcesso = new NivelAcesso($usuarioData['codnivel_acesso'], $usuarioData['tipo_acesso']);

            $usuario = new Usuario(
                $usuarioData['codusuario'],
                $usuarioData['nome'],
                $usuarioData['email'],
                $usuarioData['login'],
                $usuarioData['senha'],
                $nivelAcesso
            );

            $usuarios[] = $usuario;
        }

        return $usuarios;
    }
    public function getAll(): array
    {
        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';
        $result = (new Database('usuario'))->select(null, null, null, null, '*', $join)->fetchAll();

        $usuarios = []; // Novo array para armazenar os objetos Usuario

        foreach ($result as $usuarioData){
            $nivelAcesso = new NivelAcesso($usuarioData['codnivel_acesso'],$usuarioData['tipo_acesso']);

            $usuario = new Usuario(
                $usuarioData['codusuario'],
                $usuarioData['nome'],
                $usuarioData['email'],
                $usuarioData['login'],
                $usuarioData['senha'],
                '',
                $nivelAcesso
            );

            $usuarios[] = $usuario; // Adiciona o objeto Usuario ao array $usuarios
        }


        return $usuarios;
    }
    public function updateUsuario(int $codusuario, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        $whereClause = "codusuario = $codusuario";

        $database = new Database('usuario');
        $result = $database->update($whereClause, $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getByID(int $codusuario): ?Usuario
    {
        $where = "usuario.codusuario = '$codusuario'";
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
            $nivelAcesso
        );
    }
    public function getUsersAdmin(): array
    {
        $where = 'nivel_acesso.codnivel_acesso >= 2';

        $join = 'INNER JOIN nivel_acesso ON usuario.nivelacesso_fk = nivel_acesso.codnivel_acesso';
        $result = (new Database('usuario'))->select($where, null, null, null, '*', $join)->fetchAll();

        $usuarios = [];

        foreach ($result as $usuarioData){
            $nivelAcesso = new NivelAcesso($usuarioData['codnivel_acesso'],$usuarioData['tipo_acesso']);

            $usuario = new Usuario(
                $usuarioData['codusuario'],
                $usuarioData['nome'],
                $usuarioData['email'],
                $usuarioData['login'],
                $usuarioData['senha'],
                $nivelAcesso
            );

            $usuarios[] = $usuario;
        }

        return $usuarios;
    }
    public function getByEmail(string $email): ?Usuario
    {
        $where = "usuario.email_usuario = '$email'";
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
            $nivelAcesso
        );
    }

}