<?php

namespace app\Model\UseCase\Usuario\ValidaLogin;

use app\Model\Service\Usuario\ValidaLogin\ValidaLoginRepository;

class ValidaLoginUseCase
{
    public function execute(string $login, string $senha, ValidaLoginRepository $strategy)
    {
        return $strategy->validaLogin($login,$senha);
    }
}