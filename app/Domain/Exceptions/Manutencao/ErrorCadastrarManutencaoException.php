<?php

namespace app\Domain\Exceptions\Manutencao;

use Exception;
class ErrorCadastrarManutencaoException extends Exception
{
    public function __construct(string $message = "Não foi possível cadastrar à manutenção", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}