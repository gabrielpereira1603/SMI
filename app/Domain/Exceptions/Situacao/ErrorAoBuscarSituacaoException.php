<?php

namespace app\Domain\Exceptions\Situacao;

use Exception;

class ErrorAoBuscarSituacaoException extends Exception
{
    public function __construct(string $message = "Error ao buscar as Situações", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}