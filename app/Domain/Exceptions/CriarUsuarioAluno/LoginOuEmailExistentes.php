<?php

namespace app\Domain\Exceptions\CriarUsuarioAluno;
use Exception;

class LoginOuEmailExistentes extends Exception
{
    public function __construct(string $message = "Login ou Senha incorretos.", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}