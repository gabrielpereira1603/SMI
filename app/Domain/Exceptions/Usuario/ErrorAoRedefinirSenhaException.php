<?php

namespace app\Domain\Exceptions\Usuario;

use Exception;

class ErrorAoRedefinirSenhaException extends Exception
{
    public function __construct(string $message = "Não foi possível redefinir a senha do usuário!", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}