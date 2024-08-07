<?php

namespace app\Presentation\Utilitarios\Componentes\Select;

use app\Application\UseCase\Laboratorio\BuscarTodosLaboratoriosUseCase;
use app\Infrastructure\Dao\Laboratorio\LaboratorioDao;
use app\Infrastructure\DataBase\Laboratorio\BuscarTodosLaboratoriosDAO;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectTodosLaboratorios extends Page
{
    public static function getLaboratorioItens($request): string
    {

        $result = (new BuscarTodosLaboratoriosUseCase(new BuscarTodosLaboratoriosDAO))->execute($request);

        $itens = '';
        foreach ($result as $obLaboratorio) {
            $itens .= View::render('admin/laboratorio/selectAllLaboratorio', [
                'numerolaboratorio' => $obLaboratorio->getNumeroLaboratorio(),
                'codlaboratorio' => $obLaboratorio->getCodlaboratorio(),
            ]);
        }
        return $itens;
    }
}