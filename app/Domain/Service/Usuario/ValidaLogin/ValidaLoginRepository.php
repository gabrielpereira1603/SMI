<?php

namespace app\Domain\Service\Usuario\ValidaLogin;

interface ValidaLoginRepository
{
    public function validaLogin(string $login, string $senha): void;
}