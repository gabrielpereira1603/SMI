<?php

namespace app\Domain\Exceptions\Usuario;

use Exception;

class UsuarioNaoEncontradoException extends Exception
{
    public function __construct(string $message = "Não foi possível encontrar o usuário!", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}