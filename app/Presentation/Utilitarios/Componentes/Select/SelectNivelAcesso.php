<?php

namespace app\Utils\Componentes\Select;

use app\Model\Dao\NivelAcesso\NivelAcessoDao;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectNivelAcesso extends Page
{
    public static function getNivelAcesso($request): string
    {
        $nivelAcessos = (new NivelAcessoDao())->getAllNivelAcesso();
        foreach ($nivelAcessos as $nivelAcesso) {
            $itens .= View::render('admin/nivel_acesso/item', [
                'codnivel_acesso' => $nivelAcesso->getCodNivelAcesso(),
                'tipo_acesso' => $nivelAcesso->getTipoAcesso(),
            ]);
        }
        return $itens;
    }
}