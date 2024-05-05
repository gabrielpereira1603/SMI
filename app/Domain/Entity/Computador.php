<?php

namespace app\Domain\Entity;

class Computador
{
    private int $codcomputador;
    private string $patrimonio;
    private Situacao $situacao;
    private Laboratorio $laboratorio;

    public function __construct(int $codcomputador, string $patrimonio, Situacao $situacao, Laboratorio $laboratorio)
    {
        $this->codcomputador = $codcomputador;
        $this->patrimonio = $patrimonio;
        $this->situacao = $situacao;
        $this->laboratorio = $laboratorio;
    }

    public function getCodcomputador(): int
    {
        return $this->codcomputador;
    }

    public function setCodcomputador(int $codcomputador): Computador
    {
        $this->codcomputador = $codcomputador;
        return $this;
    }

    public function getPatrimonio(): string
    {
        return $this->patrimonio;
    }

    public function setPatrimonio(string $patrimonio): Computador
    {
        $this->patrimonio = $patrimonio;
        return $this;
    }

    public function getSituacao(): Situacao
    {
        return $this->situacao;
    }

    public function setSituacao(Situacao $situacao): Computador
    {
        $this->situacao = $situacao;
        return $this;
    }

    public function getLaboratorio(): Laboratorio
    {
        return $this->laboratorio;
    }

    public function setLaboratorio(Laboratorio $laboratorio): Computador
    {
        $this->laboratorio = $laboratorio;
        return $this;
    }
}