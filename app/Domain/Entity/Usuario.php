<?php

namespace app\Domain\Entity;

class Usuario
{
    private int $codusuario;
    private string $nome_usuario;
    private string $email_usuario;
    private string $login;
    private string $senha;
    private string $token;
    private NivelAcesso $nivelAcesso;

    public function __construct(int $codusuario, string $nome_usuario, string $email_usuario, string $login, string $senha,$token, NivelAcesso $nivelAcesso)
    {
        $this->codusuario = $codusuario;
        $this->nome_usuario = $nome_usuario;
        $this->email_usuario = $email_usuario;
        $this->login = $login;
        $this->senha = $senha;
        $this->token = $token;
        $this->nivelAcesso = $nivelAcesso;
    }

    public function getCodusuario(): int
    {
        return $this->codusuario;
    }

    public function setCodusuario(int $codusuario): Usuario
    {
        $this->codusuario = $codusuario;
        return $this;
    }

    public function getNomeUsuario(): string
    {
        return $this->nome_usuario;
    }

    public function setNomeUsuario(string $nome_usuario): Usuario
    {
        $this->nome_usuario = $nome_usuario;
        return $this;
    }

    public function getEmailUsuario(): string
    {
        return $this->email_usuario;
    }

    public function setEmailUsuario(string $email_usuario): Usuario
    {
        $this->email_usuario = $email_usuario;
        return $this;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): Usuario
    {
        $this->login = $login;
        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): Usuario
    {
        $this->senha = $senha;
        return $this;
    }

    public function getNivelAcesso(): NivelAcesso
    {
        return $this->nivelAcesso;
    }

    public function setNivelAcesso(NivelAcesso $nivelAcesso): Usuario
    {
        $this->nivelAcesso = $nivelAcesso;
        return $this;
    }

    public static function factoryUsuario(array $data): Usuario
    {
        $nivelAcesso = new NivelAcesso($data['codnivel_acesso'], $data['tipo_acesso']);

        return new Usuario(
            $data['codusuario'],
            $data['nome'],
            $data['email'],
            $data['login'],
            $data['senha'],
            $nivelAcesso
        );
    }
}