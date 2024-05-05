<?php

namespace app\Domain\Entity;

class Componente {

    public int $codcomponente;

    public string $nome_componente;

    public function __construct(int $codcomponente, string $nome_componente)
    {
        $this->codcomponente = $codcomponente;
        $this->nome_componente = $nome_componente;
    }

    public function getCodcomponente(): int
    {
        return $this->codcomponente;
    }

    public function setCodcomponente(int $codcomponente): Componente
    {
        $this->codcomponente = $codcomponente;
        return $this;
    }

    public function getNomeComponente(): string
    {
        return $this->nome_componente;
    }

    public function setNomeComponente(string $nome_componente): Componente
    {
        $this->nome_componente = $nome_componente;
        return $this;
    }
}