<?php

namespace app\Domain\Exceptions\Relatorio;

use Exception;

class ErrorAoBuscarRelatorioManutencaoException extends Exception
{
    public function __construct(string $message = "Error ao gerar relatório de manutenção!", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}