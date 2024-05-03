<?php

namespace app\Model\Entity;
use DateTime;
class Manutencao {

    private int $codmanutencao;
    private string $descricao_manutencao;
    private \DateTime $datahora_manutencao;
    private Usuario $usuario;
    private Reclamacao $reclamacao;

    public function __construct(int $codmanutencao, string $descricao_manutencao, DateTime $datahora_manutencao, Usuario $usuario, Reclamacao $reclamacao)
    {
        $this->codmanutencao = $codmanutencao;
        $this->descricao_manutencao = $descricao_manutencao;
        $this->datahora_manutencao = $datahora_manutencao;
        $this->usuario = $usuario;
        $this->reclamacao = $reclamacao;
    }

    public function getCodmanutencao(): int
    {
        return $this->codmanutencao;
    }

    public function setCodmanutencao(int $codmanutencao): Manutencao
    {
        $this->codmanutencao = $codmanutencao;
        return $this;
    }

    public function getDescricaoManutencao(): string
    {
        return $this->descricao_manutencao;
    }

    public function setDescricaoManutencao(string $descricao_manutencao): Manutencao
    {
        $this->descricao_manutencao = $descricao_manutencao;
        return $this;
    }

    public function getDatahoraManutencao(): DateTime
    {
        return $this->datahora_manutencao;
    }

    public function setDatahoraManutencao(DateTime $datahora_manutencao): Manutencao
    {
        $this->datahora_manutencao = $datahora_manutencao;
        return $this;
    }

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): Manutencao
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getReclamacao(): Reclamacao
    {
        return $this->reclamacao;
    }

    public function setReclamacao(Reclamacao $reclamacao): Manutencao
    {
        $this->reclamacao = $reclamacao;
        return $this;
    }

}