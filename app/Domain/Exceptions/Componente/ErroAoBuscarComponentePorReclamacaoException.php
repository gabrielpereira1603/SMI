<?php

namespace app\Domain\Exceptions\Componente;

use Exception;

class ErroAoBuscarComponentePorReclamacaoException extends Exception
{
    public function __construct(string $message = "Não foi possível encontrado componentes pelo código da reclamação fornecido", int $code = 1, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}