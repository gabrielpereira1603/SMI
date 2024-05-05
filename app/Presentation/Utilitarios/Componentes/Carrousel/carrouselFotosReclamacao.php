<?php

namespace app\Presentation\Utilitarios\Componentes\Carrousel;

use app\Infrastructure\Dao\Foto\FotoDao;
use app\Presentation\Controller\Admin\Page;
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