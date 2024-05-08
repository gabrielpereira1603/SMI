<?php

namespace app\Domain\Service\Usuario;

use app\Domain\Entity\Usuario;

interface UsuarioRepository
{
    public function getAll(): array;

    public function getByLogin(string $login): ?Usuario;

    public function createUsuario($login,$email,$nome,$nivel_acesso,$senha): bool;

    public function updateUsuario(int $id, array $data): bool;

    public function getByID(int $codusuario): ?Usuario;

    //public function delete(int $id): bool;
}