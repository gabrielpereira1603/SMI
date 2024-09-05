<?php

namespace app\Presentation\Utilitarios\Componentes\Select;

use app\Infrastructure\Dao\Componente\ComponenteDao;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectTodosComponentes extends Page
{
    public static function selectAllComponentes(Request $request)
    {
        $allComponentes = ComponenteDao::getAllComponentes();
        $itens = '';
        foreach ($allComponentes as $componentes) {
            $itens .= View::render('admin/componente/selectComponente', [
                'codcomponente' => $componentes->getCodComponente(),
                'nome_componente' => $componentes->getNomeComponente(),
            ]);
        }

        return parent::getPage('Select Componentes', $itens);
    }
}