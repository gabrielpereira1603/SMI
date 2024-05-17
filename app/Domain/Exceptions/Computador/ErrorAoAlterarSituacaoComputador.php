<?php

namespace app\Domain\Exceptions\Computador;

use Exception;
class ErrorAoAlterarSituacaoComputador extends Exception
{
    public function __construct(string $message = "Error ao alterar a situação do computador!", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}