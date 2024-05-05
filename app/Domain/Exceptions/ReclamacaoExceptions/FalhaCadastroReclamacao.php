<?php

namespace app\Domain\Exceptions\ReclamacaoExceptions;

use Exception;

class FalhaCadastroReclamacao extends Exception
{
    public function __construct(string $message = "Error ao cadastrar reclamação.", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}