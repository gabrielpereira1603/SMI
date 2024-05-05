<?php

namespace app\Domain\Entity;

class Situacao
{
    private int $codsituacao;
    private string $tipoSituacao;

    public function __construct(int $codsituacao, string $tipoSituacao)
    {
        $this->codsituacao = $codsituacao;
        $this->tipoSituacao = $tipoSituacao;
    }

    public function getCodsituacao(): int
    {
        return $this->codsituacao;
    }

    public function setCodsituacao(int $codsituacao): Situacao
    {
        $this->codsituacao = $codsituacao;
        return $this;
    }

    public function getTipoSituacao(): string
    {
        return $this->tipoSituacao;
    }

    public function setTipoSituacao(string $tipoSituacao): Situacao
    {
        $this->tipoSituacao = $tipoSituacao;
        return $this;
    }

}