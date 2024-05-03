<?php

namespace app\Model\Service\Usuario\ValidaLogin;

interface ValidaLoginRepository
{
    public function validaLogin(string $login, string $senha): void;
}