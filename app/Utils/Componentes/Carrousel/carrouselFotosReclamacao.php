<?php

namespace app\Utils\Componentes\Carrousel;

use app\Controller\Admin\Page;
use app\Model\Dao\Foto\FotoDao;
use app\Utils\View;

class carrouselFotosReclamacao extends Page
{
    public static function getFotosView($codreclamacao): string
    {
        $fotoDao = new FotoDao();
        $result = $fotoDao->buscarPorReclamacao($codreclamacao);
        $content = '';
        foreach ($result as $foto) {
            $base64Image = base64_encode($foto['foto']);

            $content .= View::render('admin/foto/item', [
                'foto_url' => $base64Image,
            ]);
        }

        return parent::getPage('Fotos da Reclamação', $content);
    }
}