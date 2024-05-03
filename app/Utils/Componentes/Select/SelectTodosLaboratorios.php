<?php

namespace app\Utils\Componentes\Select;

use app\Controller\Admin\Page;
use app\Model\Dao\Laboratorio\LaboratorioDao;
use app\Utils\View;

class SelectTodosLaboratorios extends Page
{
    public static function getLaboratorioItens($request): string
    {

        $result = (new LaboratorioDao())->getAllLaboratorios();

        foreach ($result as $obLaboratorio) {
            $itens .= View::render('admin/laboratorio/selectAllLaboratorio', [
                'numerolaboratorio' => $obLaboratorio->getNumeroLaboratorio(),
                'codlaboratorio' => $obLaboratorio->getCodlaboratorio(),
            ]);
        }
        return $itens;
    }
}