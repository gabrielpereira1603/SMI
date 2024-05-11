<?php

namespace app\Infrastructure\DataBase\Usuario;

use app\Domain\Entity\Usuario;
use app\Domain\Repository\Usuario\CriarUsuarioRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class CriarUsuarioDAO implements CriarUsuarioRepository
{

    public function criarUsuario(Request $request, array $usuario): bool
    {
        $database = new Database('usuario');

        $lastID = $database->insert([
            'nome_usuario' => $usuario['nome'],
            'email_usuario' => $usuario['email'],
            'login' => $usuario['login'],
            'senha' => $usuario['senha'],
            'nivelacesso_fk' => $usuario['codnivel_acesso'],
        ]);

        if ($lastID === null){
            return false;
        }
        return true;
    }
}