<?php

namespace app\Domain\Entity;

class ReclamacaoComponente {
    private int $codreclamacao_fk;
    private int $codcomponente_fk;

    public function __construct($codreclamacao_fk, $codcomponente_fk)
    {
        $this->codreclamacao_fk = $codreclamacao_fk;
        $this->codcomponente_fk = $codcomponente_fk;
    }

    public function getCodreclamacaoFk(): int
    {
        return $this->codreclamacao_fk;
    }

    public function setCodreclamacaoFk(int $codreclamacao_fk): ReclamacaoComponente
    {
        $this->codreclamacao_fk = $codreclamacao_fk;
        return $this;
    }

    public function getCodcomponenteFk(): int
    {
        return $this->codcomponente_fk;
    }

    public function setCodcomponenteFk(int $codcomponente_fk): ReclamacaoComponente
    {
        $this->codcomponente_fk = $codcomponente_fk;
        return $this;
    }


}
