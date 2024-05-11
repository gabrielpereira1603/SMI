<?php

namespace app\Domain\Service\Usuario\ValidaLogin;

use app\Infrastructure\Http\Request;

interface ValidaLoginRepository
{
    public function validaLogin(Request $request, string $login, string $senha): void;
}