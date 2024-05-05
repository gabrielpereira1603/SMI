<?php

namespace app\Domain\Dao\NivelAcesso;

use app\Domain\Entity\NivelAcesso;
use WilliamCosta\DatabaseManager\Database;

class NivelAcessoDao
{
    public function getAllNivelAcesso(): array
    {
        $result = (new Database('nivel_acesso'))->select()->fetchAll();

        foreach ($result as $nivelAcessoData){
            $nivelAcesso[] = new NivelAcesso(
                $nivelAcessoData['codnivel_acesso'],
                $nivelAcessoData['tipo_acesso'],
            );
        }

        return $nivelAcesso;
    }
}