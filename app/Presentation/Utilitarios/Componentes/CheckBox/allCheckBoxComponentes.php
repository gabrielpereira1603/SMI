<?php

namespace app\Presentation\Utilitarios\Componentes\CheckBox;

use app\Infrastructure\Dao\Componente\ComponenteDao;
use app\Utils\View;

class allCheckBoxComponentes
{
    public static function getComponenteCheckBox($request): string
    {
        $componenteDao = new ComponenteDao();
        $results = $componenteDao->getAllComponentes();

        $itens = '';

        foreach ($results as $componente) { // Alteração aqui
            $itens .= View::render('aluno/componente/item', [
                'nome_componente' => $componente->getNomeComponente(), // Alteração aqui
                'codcomponente' => $componente->getCodcomponente(), // Alteração aqui
            ]);
        }

        return $itens;
    }
}