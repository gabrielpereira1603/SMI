<?php

namespace app\Utils\Componentes\CheckBox;

use app\Model\Dao\ReclamacaoComponente\ReclamacaoComponenteDao;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class checkBoxSelected extends Page
{
    public static function getComponentesView($codreclamacao): string
    {
        $reclamacaoComponenteDao = new ReclamacaoComponenteDao();
        $results = $reclamacaoComponenteDao->getComponenteReclamacao($codreclamacao);

        $content = '';
        foreach ($results as $obReclamacao) {
            $content .= View::render('admin/componente/item', [
                'nome_componente'   => $obReclamacao->getNomeComponente(),
            ]);

        }
        return parent::getPage('Manutenção', $content);
    }
}