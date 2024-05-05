<?php

namespace app\Application\UseCase\Usuario\ValidaLogin;

use app\Domain\Service\Usuario\ValidaLogin\ValidaLoginRepository;

class ValidaLoginUseCase
{
    private ValidaLoginRepository $strategy;

    public function __construct(ValidaLoginRepository $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(string $login, string $senha)
    {
        return $this->strategy->validaLogin($login, $senha);
    }
}