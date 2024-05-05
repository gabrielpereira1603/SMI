<?php

namespace app\Exceptions\ReclamacaoExceptions;

use Exception;

class ErrorAoExcluirReclamacaoException extends Exception
{
    public function __construct(string $message = "Error ao excluir a reclamação", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}