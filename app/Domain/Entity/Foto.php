<?php

namespace app\Domain\Entity;

class Foto {
    private int $codfoto;

    private string $valorFoto ;

    public Reclamacao $reclamacao;

    public function __construct(int $codfoto, string $valorFoto, Reclamacao $reclamacao)
    {
        $this->codfoto = $codfoto;
        $this->valorFoto = $valorFoto;
        $this->reclamacao = $reclamacao;
    }

    public function getCodfoto(): int
    {
        return $this->codfoto;
    }

    public function setCodfoto(int $codfoto): Foto
    {
        $this->codfoto = $codfoto;
        return $this;
    }

    public function getValorFoto(): string
    {
        return $this->valorFoto;
    }

    public function setValorFoto(string $valorFoto): Foto
    {
        $this->valorFoto = $valorFoto;
        return $this;
    }

    public function getReclamacao(): Reclamacao
    {
        return $this->reclamacao;
    }

    public function setReclamacao(Reclamacao $reclamacao): Foto
    {
        $this->reclamacao = $reclamacao;
        return $this;
    }
}