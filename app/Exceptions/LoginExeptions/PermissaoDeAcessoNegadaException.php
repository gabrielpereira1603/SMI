<?php

namespace app\Exceptions\LoginExeptions;

use Exception;

class PermissaoDeAcessoNegadaException extends Exception
{
    public function __construct(string $message = "Usuário sem permissão para acessar.", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}