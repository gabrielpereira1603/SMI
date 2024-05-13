<?php

namespace app\Infrastructure\DataBase\Usuario;

use app\Domain\Entity\NivelAcesso;
use app\Domain\Entity\Usuario;
use app\Domain\Repository\Usuario\BuscarUsuarioPorEmailRepository;
use WilliamCosta\DatabaseManager\Database;

class BuscarUsuarioPorEmailDAO implements BuscarUsuarioPorEmailRepository
{

    public function buscarPorEmail(string $email): ?Usuario
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
            $usuarioData['nome_usuario'],
            $usuarioData['email_usuario'],
            $usuarioData['login'],
            $usuarioData['senha'],
            '',
            $nivelAcesso
        );
    }
}