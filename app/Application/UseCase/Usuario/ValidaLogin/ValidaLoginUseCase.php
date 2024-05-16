<?php

namespace app\Application\UseCase\Usuario\ValidaLogin;

use app\Domain\Repository\Usuario\ValidaLoginRepository;
use app\Infrastructure\Http\Request;

class ValidaLoginUseCase
{
    private ValidaLoginRepository $strategy;

    public function __construct(ValidaLoginRepository $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(Request $request, string $login, string $senha)
    {
        return $this->strategy->validaLogin($request,$login, $senha);
    }
}