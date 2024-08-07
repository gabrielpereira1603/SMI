<?php

namespace app\Presentation\Utilitarios\Componentes\Select;

use app\Infrastructure\Dao\NivelAcesso\NivelAcessoDao;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectNivelAcesso extends Page
{
    public static function getNivelAcesso($request): string
    {
        $nivelAcessos = (new NivelAcessoDao())->getAllNivelAcesso();
        $itens = '';
        foreach ($nivelAcessos as $nivelAcesso) {
            $itens .= View::render('admin/nivel_acesso/item', [
                'codnivel_acesso' => $nivelAcesso->getCodNivelAcesso(),
                'tipo_acesso' => $nivelAcesso->getTipoAcesso(),
            ]);
        }
        return $itens;
    }
}