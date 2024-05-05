<?php

namespace app\Domain\Exceptions\InserirManutencao;
use Exception;

class CampsVaziosException extends Exception
{
    public function __construct(string $message = "Prencha todos os campos.", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}