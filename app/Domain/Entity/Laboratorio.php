<?php

namespace app\Model\Entity;

class Laboratorio
{
    private int $codlaboratorio;
    private string $numeroLaboratorio;

    public function __construct(int $codlaboratorio, string $numeroLaboratorio)
    {
        $this->codlaboratorio = $codlaboratorio;
        $this->numeroLaboratorio = $numeroLaboratorio;
    }

    public function getCodlaboratorio(): int
    {
        return $this->codlaboratorio;
    }

    public function setCodlaboratorio(int $codlaboratorio): Laboratorio
    {
        $this->codlaboratorio = $codlaboratorio;
        return $this;
    }

    public function getNumeroLaboratorio(): string
    {
        return $this->numeroLaboratorio;
    }

    public function setNumeroLaboratorio(string $numeroLaboratorio): Laboratorio
    {
        $this->numeroLaboratorio = $numeroLaboratorio;
        return $this;
    }

}