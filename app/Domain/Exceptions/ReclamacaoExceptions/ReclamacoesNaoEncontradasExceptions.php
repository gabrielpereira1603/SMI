<?php

namespace app\Domain\Exceptions\ReclamacaoExceptions;
use Exception;
class ReclamacoesNaoEncontradasExceptions extends Exception
{
    public function __construct(string $message = "Nenhuma reclamação encontrada!", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}