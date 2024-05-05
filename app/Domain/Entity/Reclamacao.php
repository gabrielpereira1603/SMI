<?php

namespace app\Domain\Entity;

class Reclamacao {

    private int $codreclamaca;
    private string $descricao;
    private int $prazoReclamacao;
    private string $status;
    private \DateTime $dataHora_Reclamacao;
    private \DateTime $dataHora_fimReclamacao;
    private Computador $computador;
    private Laboratorio $laboratorio;
    private Usuario $usuario;

    public function __construct(int $codreclamaca, string $descricao, int $prazoReclamacao, string $status, \DateTime $dataHora_Reclamacao, \DateTime $dataHora_fimReclamacao, Computador $computador, Laboratorio $laboratorio, Usuario $usuario)
    {
        $this->codreclamaca = $codreclamaca;
        $this->descricao = $descricao;
        $this->prazoReclamacao = $prazoReclamacao;
        $this->status = $status;
        $this->dataHora_Reclamacao = $dataHora_Reclamacao;
        $this->dataHora_fimReclamacao = $dataHora_fimReclamacao;
        $this->computador = $computador;
        $this->laboratorio = $laboratorio;
        $this->usuario = $usuario;
    }

    public function getCodreclamaca(): int
    {
        return $this->codreclamaca;
    }

    public function setCodreclamaca(int $codreclamaca): Reclamacao
    {
        $this->codreclamaca = $codreclamaca;
        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): Reclamacao
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getPrazoReclamacao(): int
    {
        return $this->prazoReclamacao;
    }

    public function setPrazoReclamacao(int $prazoReclamacao): Reclamacao
    {
        $this->prazoReclamacao = $prazoReclamacao;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Reclamacao
    {
        $this->status = $status;
        return $this;
    }

    public function getDataHoraReclamacao(): \DateTime
    {
        return $this->dataHora_Reclamacao;
    }

    public function setDataHoraReclamacao(\DateTime $dataHora_Reclamacao): Reclamacao
    {
        $this->dataHora_Reclamacao = $dataHora_Reclamacao;
        return $this;
    }

    public function getDataHoraFimReclamacao(): \DateTime
    {
        return $this->dataHora_fimReclamacao;
    }

    public function setDataHoraFimReclamacao(\DateTime $dataHora_fimReclamacao): Reclamacao
    {
        $this->dataHora_fimReclamacao = $dataHora_fimReclamacao;
        return $this;
    }

    public function getComputador(): Computador
    {
        return $this->computador;
    }

    public function setComputador(Computador $computador): Reclamacao
    {
        $this->computador = $computador;
        return $this;
    }

    public function getLaboratorio(): Laboratorio
    {
        return $this->laboratorio;
    }

    public function setLaboratorio(Laboratorio $laboratorio): Reclamacao
    {
        $this->laboratorio = $laboratorio;
        return $this;
    }

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): Reclamacao
    {
        $this->usuario = $usuario;
        return $this;
    }

}
