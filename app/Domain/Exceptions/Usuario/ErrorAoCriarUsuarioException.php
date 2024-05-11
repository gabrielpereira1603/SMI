<?php

namespace app\Domain\Exceptions\Usuario;

use Exception;

class ErrorAoCriarUsuarioException extends Exception
{
    public function __construct(string $message = "Não foi possível cadastrar usuário!", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}