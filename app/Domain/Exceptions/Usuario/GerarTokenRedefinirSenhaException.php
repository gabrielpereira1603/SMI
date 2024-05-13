<?php

namespace app\Domain\Exceptions\Usuario;

use Exception;

class GerarTokenRedefinirSenhaException extends Exception
{
    public function __construct(string $message = "Não foi possível gerar o Token!", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}