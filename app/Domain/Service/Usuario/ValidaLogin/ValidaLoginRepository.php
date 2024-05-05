<?php

namespace app\Domain\Repository\Usuario\ValidaLogin;

interface ValidaLoginRepository
{
    public function validaLogin(string $login, string $senha): void;
}