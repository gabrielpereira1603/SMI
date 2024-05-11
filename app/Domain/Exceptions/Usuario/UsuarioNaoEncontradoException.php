<?php

namespace app\Domain\Exceptions\LoginExeptions;

use Exception;
class UsuarioNaoEncontradoException extends Exception
{
    public function __construct(string $message = "Usuário não encontrado!", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}