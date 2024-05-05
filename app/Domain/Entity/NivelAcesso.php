<?php

namespace app\Domain\Entity;

class NivelAcesso {

    private int $codNivelAcesso;
    private string $tipoAcesso;

    public function __construct(int $codNivelAcesso, string $tipoAcesso)
    {
        $this->codNivelAcesso = $codNivelAcesso;
        $this->tipoAcesso = $tipoAcesso;
    }

    public function getCodNivelAcesso(): int
    {
        return $this->codNivelAcesso;
    }

    public function getTipoAcesso(): string
    {
        return $this->tipoAcesso;
    }

    public function __toString(): string
    {
        return $this->tipoAcesso;
    }
}