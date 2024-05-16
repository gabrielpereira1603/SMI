<?php

namespace app\Domain\Repository\Usuario;

use app\Infrastructure\Http\Request;

interface ValidaLoginRepository
{
    public function validaLogin(Request $request, string $login, string $senha): void;

}