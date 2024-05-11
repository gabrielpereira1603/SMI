<?php

namespace app\Domain\Exceptions\NivelAcesso;

use Exception;

class NivelAcessoNaoEncontradoException extends Exception
{
    public function __construct(string $message = "Nivel de Acesso não encontrado!", int $code = 2, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}